<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

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
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return Response
     */
    public function store(StoreUserRequest $request)
    {
        //
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
        //Log::info($request);
        //Log::info($user);
        return response()->json(__('user.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function destroy(User $user): JsonResponse
    {
        $user->status = 'inactive';
        $user->save();
        $user->delete();
        return response()->json(__('user.deleted'));
    }
}
