<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSlaRequest;
use App\Http\Requests\UpdateSlaRequest;
use App\Models\Sla;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class SlaController extends Controller
{
    /**
     * Return a listing of the resource.
     *
     * @return Builder[]|Collection
     */
    public function index(): Collection|array
    {
        return Sla::listAllOrdered()->withTrashed()->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreSlaRequest  $request
     * @return JsonResponse
     */
    public function store(StoreSlaRequest $request): JsonResponse
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  Sla  $sla
     * @return Response|Sla
     */
    public function show(Sla $sla): Response|Sla
    {
        return $sla->load($sla->relationsNested());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Sla  $sla
     * @return Response|Sla
     */
    public function edit(Sla $sla): Response|Sla
    {
        return $sla->load($sla->relationsNested());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateSlaRequest  $request
     * @param  Sla  $sla
     * @return JsonResponse
     */
    public function update(UpdateSlaRequest $request, Sla $sla): JsonResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Sla  $sla
     * @return JsonResponse
     */
    public function destroy(Sla $sla): JsonResponse
    {
        $sla->delete();
        $sla->status = 'inactive';
        $sla->save();

        return response()->json(__('notification.inactivated', ['attribute' => 'SLA']));
    }
}
