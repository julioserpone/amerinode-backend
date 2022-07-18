<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Branch;
use App\Models\Project;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Builder[]|Collection
     */
    public function index(): Collection|array
    {
        return Project::listAllOrdered()->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreProjectRequest  $request
     * @return JsonResponse
     */
    public function store(StoreProjectRequest $request): JsonResponse
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  Project  $project
     * @return Response|Project
     */
    public function show(Project $project): Response|Project
    {
        return $project->load($project->relationsNested());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Project  $project
     * @return Response|Project
     */
    public function edit(Project $project): Response|Project
    {
        return $project->load($project->relationsNested());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateProjectRequest  $request
     * @param  Project  $project
     * @return JsonResponse
     */
    public function update(UpdateProjectRequest $request, Project $project): JsonResponse
    {
        $branch = Branch::where('country_id', $request->country['id'])
            ->where('company_id', $request->company['id'])
            ->first();

        $duplicate = Project::duplicate($request->project_type['id'], $branch->id, $request->project['name'], $request->project['description'], $project->id)->first();

        if ($duplicate) {
            return response()->json(['message' => __('notification.duplicated')], 409);
        }

        $project->update([
            'name' => $request->project['name'],
            'description' => $request->project['description'],
            'project_type_id' => $request->project_type['id'],
            'branch_id' => $branch->id,
            'status' => $request->status['id'],
        ]);

        return response()->json(__('notification.updated', ['attribute' => 'project']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Project  $project
     * @return JsonResponse
     */
    public function destroy(Project $project): JsonResponse
    {
        $project->delete();
        $project->status = 'inactive';
        $project->save();

        return response()->json(__('notification.inactivated', ['attribute' => 'project']));
    }
}
