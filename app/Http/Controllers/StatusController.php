<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStatusRequest;
use App\Http\Requests\UpdateStatusRequest;
use App\Models\Status;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class StatusController extends Controller
{
    /**
     * Return a listing of the resource.
     *
     * @return Builder[]|Collection
     */
    public function index(): Collection|array
    {
        return Status::withTrashed()->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreStatusRequest  $request
     * @return JsonResponse
     */
    public function store(StoreStatusRequest $request): JsonResponse
    {
        $company = Status::create([
            'description' => $request->data['description'],
            'module' => $request->data['module'],
        ]);

        $company->status = $request->status['id'];
        $company->save();

        return response()->json(__('notification.created', ['attribute' => 'status']));
    }

    /**
     * Display the specified resource.
     *
     * @param  Status  $status
     * @return Response|Status
     */
    public function show(Status $status): Response|Status
    {
        return $status;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Status  $status
     * @return Response|Status
     */
    public function edit(Status $status): Response|Status
    {
        return $status;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateStatusRequest  $request
     * @param  Status  $status
     * @return JsonResponse
     */
    public function update(UpdateStatusRequest $request, Status $status): JsonResponse
    {
        $status->update($request->data);
        $status->status = $request->status['id'];
        $status->save();

        return response()->json(__('notification.updated', ['attribute' => 'status']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Status  $status
     * @return JsonResponse
     */
    public function destroy(Status $status): JsonResponse
    {
        $status->status = 'inactive';
        $status->save();

        return response()->json(__('notification.deleted', ['attribute' => 'status']));
    }
}
