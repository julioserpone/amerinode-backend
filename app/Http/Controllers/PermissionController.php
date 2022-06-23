<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Return a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index(): \Illuminate\Database\Eloquent\Collection|array
    {
        return Permission::orderBy('name')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePermissionRequest $request
     * @return JsonResponse
     */
    public function store(StorePermissionRequest $request): JsonResponse
    {
        Permission::create([
            'name' => $request->permission['name'],
            'description' => $request->permission['description'],
            'guard_name' => $request->permission['guard_name'],
        ]);

        return response()->json(__('notification.created', ['attribute' => 'permission']));
    }

    /**
     * Return the specified resource.
     *
     * @param Permission $permission
     * @return Response|Permission
     */
    public function show(Permission $permission): Response|Permission
    {
        return $permission;
    }

    /**
     * Return the specified resource for editing
     *
     * @param Permission $permission
     * @return Response|Permission
     */
    public function edit(Permission $permission): Response|Permission
    {
        return $permission;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePermissionRequest $request
     * @param Permission $permission
     * @return JsonResponse
     */
    public function update(UpdatePermissionRequest $request, Permission $permission): JsonResponse
    {
        $permission->update($request->permission);
        $permission->status = $request->status['id'];
        $permission->save();

        return response()->json(__('notification.updated', ['attribute' => 'permission']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Permission $permission
     * @return JsonResponse
     */
    public function destroy(Permission $permission): JsonResponse
    {
        $permission->status = 'inactive';
        $permission->save();
        return response()->json(__('notification.deleted', ['attribute' => 'permission']));
    }
}
