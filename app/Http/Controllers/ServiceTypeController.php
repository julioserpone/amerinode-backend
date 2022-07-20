<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServiceTypeRequest;
use App\Http\Requests\UpdateServiceTypeRequest;
use App\Models\ServiceType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ServiceTypeController extends Controller
{
    /**
     * Return a listing of the resource.
     *
     * @return Builder[]|Collection
     */
    public function index(): Collection|array
    {
        return ServiceType::withTrashed()->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreServiceTypeRequest  $request
     * @return JsonResponse
     */
    public function store(StoreServiceTypeRequest $request): JsonResponse
    {
        $service_type = ServiceType::create([
            'description' => $request->service_type['description'],
        ]);

        $service_type->status = $request->status['id'];
        $service_type->save();

        return response()->json(__('notification.created', ['attribute' => 'service type']));
    }

    /**
     * Display the specified resource.
     *
     * @param  ServiceType  $service_type
     * @return Response|ServiceType
     */
    public function show(ServiceType $service_type): Response|ServiceType
    {
        return $service_type;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  ServiceType  $service_type
     * @return Response|ServiceType
     */
    public function edit(ServiceType $service_type): Response|ServiceType
    {
        return $service_type;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateServiceTypeRequest  $request
     * @param  ServiceType  $service_type
     * @return JsonResponse
     */
    public function update(UpdateServiceTypeRequest $request, ServiceType $service_type): JsonResponse
    {
        if ($request->status['id'] == 'active') {
            if ($service_type->trashed()) {
                $service_type->restore();
            }
        } else {
            $service_type->delete();
        }
        $service_type->update($request->service_type);
        $service_type->status = $request->status['id'];
        $service_type->save();

        return response()->json(__('notification.updated', ['attribute' => 'service type']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  ServiceType  $service_type
     * @return JsonResponse
     */
    public function destroy(ServiceType $service_type): JsonResponse
    {
        $service_type->delete();
        $service_type->status = 'inactive';
        $service_type->save();

        return response()->json(__('notification.inactivated', ['attribute' => 'service type']));
    }
}
