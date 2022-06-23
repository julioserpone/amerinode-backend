<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Return a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index(): \Illuminate\Database\Eloquent\Collection|array
    {
        return User::withTrashed()->with('roles')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserRequest $request
     * @return JsonResponse
     */
    public function store(StoreUserRequest $request): JsonResponse
    {
        $rol = data_get($request->role,'name');

        $user = User::create([
            'title' => $request->user['title'],
            'name' => $request->user['name'],
            'username' => $request->user['username'],
            'mobile_phone' => $request->user['mobile_phone'],
            'work_phone' => $request->user['work_phone'],
            'email' => $request->user['email'],
            'password' => Hash::make($request->user['password']),
            'status' => $request->status['id'],
        ]);

        //synchronized roles
        $user->syncRoles($rol);

        event(new Registered($user));

        return response()->json(__('notification.created', ['attribute' => 'user']));
    }

    /**
     * Return the specified resource.
     *
     * @param User $user
     * @return Response|User
     */
    public function show(User $user): Response|User
    {
        return $user->load('roles','permissions');
    }

    /**
     * Return the specified resource for editing
     *
     * @param User $user
     * @return  Response|User
     */
    public function edit(User $user): Response|User
    {
        return $user->load('roles','permissions');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @param User $user
     * @return JsonResponse
     */
    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        $rol = data_get($request->role,'name');

        if ($request->status['id'] == 'active') {
            //Restore user
            if ($user->trashed()) {
                $user->restore();
            }
        } else {
            $user->delete();
        }

        $user->update($request->user);
        $user->status = $request->status['id'];
        $user->save();

        //synchronized roles
        $user->syncRoles($rol);

        return response()->json(__('notification.updated', ['attribute' => 'user']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function destroy(User $user): JsonResponse
    {
        $user->delete();
        $user->status = 'inactive';
        $user->save();
        return response()->json(__('notification.deleted', ['attribute' => 'user']));
    }
}
