<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectTypeRequest;
use App\Http\Requests\UpdateProjectTypeRequest;
use App\Models\ProjectType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ProjectTypeController extends Controller
{
    /**
     * Return a listing of the resource.
     *
     * @return Builder[]|Collection
     */
    public function index(): Collection|array
    {
        return ProjectType::allWithServiceType()->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreProjectTypeRequest  $request
     * @return JsonResponse
     */
    public function store(StoreProjectTypeRequest $request): JsonResponse
    {
        $service_type = ProjectType::create([
            'description' => $request->project_type['description'],
            'service_type_id' => $request->service_type['id'],
        ]);

        $service_type->status = $request->status['id'];
        $service_type->save();

        return response()->json(__('notification.created', ['attribute' => 'project type']));
    }

    /**
     * Display the specified resource.
     *
     * @param  ProjectType  $project_type
     * @return Response|ProjectType
     */
    public function show(ProjectType $project_type): Response|ProjectType
    {
        return $project_type->load('serviceType');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  ProjectType  $project_type
     * @return Response|ProjectType
     */
    public function edit(ProjectType $project_type): Response|ProjectType
    {
        return $project_type->load('serviceType');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateProjectTypeRequest  $request
     * @param  ProjectType  $project_type
     * @return JsonResponse
     */
    public function update(UpdateProjectTypeRequest $request, ProjectType $project_type): JsonResponse
    {
        if ($request->status['id'] == 'active') {
            if ($project_type->trashed()) {
                $project_type->restore();
            }
        } else {
            $project_type->delete();
        }
        $project_type->update([
            'description' => $request->project_type['description'],
            'service_type_id' => $request->service_type['id'],
        ]);
        $project_type->status = $request->status['id'];
        $project_type->save();

        return response()->json(__('notification.updated', ['attribute' => 'project type']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  ProjectType  $project_type
     * @return JsonResponse
     */
    public function destroy(ProjectType $project_type): JsonResponse
    {
        $project_type->delete();
        $project_type->status = 'inactive';
        $project_type->save();

        return response()->json(__('notification.inactivated', ['attribute' => 'project type']));
    }
}
