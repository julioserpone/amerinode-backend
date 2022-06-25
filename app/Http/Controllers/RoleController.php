<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Return a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index(): \Illuminate\Database\Eloquent\Collection|array
    {
        return Role::with('permissions')->orderBy('name')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRoleRequest $request
     * @return JsonResponse
     */
    public function store(StoreRoleRequest $request): JsonResponse
    {
        $permissions = Arr::pluck($request->permissions, 'name');

        $role = Role::create([
            'name' => $request->role['name'],
            'description' => $request->role['description'],
            'guard_name' => $request->role['guard_name'],
        ]);

        //synchronized permission
        $role->syncPermissions($permissions);

        return response()->json(__('notification.created', ['attribute' => 'role']));
    }

    /**
     * Return the specified resource.
     *
     * @param Role $role
     * @return Response|Role
     */
    public function show(Role $role): Response|Role
    {
        return $role->load('permissions');
    }

    /**
     * Return the specified resource for editing
     *
     * @param Role $role
     * @return Response|Role
     */
    public function edit(Role $role): Response|Role
    {
        return $role->load('permissions');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRoleRequest $request
     * @param Role $role
     * @return JsonResponse
     */
    public function update(UpdateRoleRequest $request, Role $role): JsonResponse
    {
        $permissions = Arr::pluck($request->permissions, 'name');

        $role->update($request->role);
        $role->status = $request->status['id'];
        $role->save();

        //synchronized permission
        $role->syncPermissions($permissions);

        return response()->json(__('notification.updated', ['attribute' => 'role']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Role $role
     * @return JsonResponse
     */
    public function destroy(Role $role): JsonResponse
    {
        $role->status = 'inactive';
        $role->save();
        return response()->json(__('notification.deleted', ['attribute' => 'role']));
    }
}
