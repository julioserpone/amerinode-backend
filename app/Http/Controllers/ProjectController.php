<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
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
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return Response
     */
    public function store(StoreProjectRequest $request)
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
     * @return Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Project  $project
     * @return Response
     */
    public function destroy(Project $project)
    {
        //
    }
}
