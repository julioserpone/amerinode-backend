<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOemRequest;
use App\Http\Requests\UpdateOemRequest;
use App\Models\Oem;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class OemController extends Controller
{
    /**
     * Return a listing of the resource.
     *
     * @return Builder[]|Collection
     */
    public function index(): Collection|array
    {
        return Oem::withTrashed()->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreOemRequest  $request
     * @return JsonResponse
     */
    public function store(StoreOemRequest $request): JsonResponse
    {
        $oem = Oem::create([
            'description' => $request->oem['description'],
        ]);

        $oem->status = $request->status['id'];
        $oem->save();

        return response()->json(__('notification.created', ['attribute' => 'OEM']));
    }

    /**
     * Display the specified resource.
     *
     * @param  Oem  $oem
     * @return Response|Oem
     */
    public function show(Oem $oem): Response|Oem
    {
        return $oem;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Oem  $oem
     * @return Response|Oem
     */
    public function edit(Oem $oem): Response|Oem
    {
        return $oem;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateOemRequest  $request
     * @param  Oem  $oem
     * @return JsonResponse
     */
    public function update(UpdateOemRequest $request, Oem $oem): JsonResponse
    {
        if ($request->status['id'] == 'active') {
            if ($oem->trashed()) {
                $oem->restore();
            }
        } else {
            $oem->delete();
        }
        $oem->update($request->oem);
        $oem->status = $request->status['id'];
        $oem->save();

        return response()->json(__('notification.updated', ['attribute' => 'OEM']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Oem  $oem
     * @return JsonResponse
     */
    public function destroy(Oem $oem): JsonResponse
    {
        $oem->delete();
        $oem->status = 'inactive';
        $oem->save();

        return response()->json(__('notification.deleted', ['attribute' => 'OEM']));
    }
}
