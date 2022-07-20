<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSeverityRequest;
use App\Http\Requests\UpdateSeverityRequest;
use App\Models\Severity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class SeverityController extends Controller
{
    /**
     * Return a listing of the resource.
     *
     * @return Builder[]|Collection
     */
    public function index(): Collection|array
    {
        return Severity::withTrashed()->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreSeverityRequest  $request
     * @return JsonResponse
     */
    public function store(StoreSeverityRequest $request): JsonResponse
    {
        $duplicate = Severity::duplicate($request->data)->first();
        if ($duplicate) {
            return response()->json(['message' => __('notification.duplicated')], 409);
        }
        Severity::create([
            'code' => $request->data['code'],
            'name' => $request->data['name'],
            'description' => $request->data['description'],
            'color' => $request->data['color'],
            'status' => $request->status['id'],
        ]);

        return response()->json(__('notification.created', ['attribute' => 'severity']));
    }

    /**
     * Display the specified resource.
     *
     * @param  Severity  $severity
     * @return Response|Severity
     */
    public function show(Severity $severity): Response|Severity
    {
        return $severity;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Severity  $severity
     * @return Response|Severity
     */
    public function edit(Severity $severity): Response|Severity
    {
        return $severity;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateSeverityRequest  $request
     * @param  Severity  $severity
     * @return JsonResponse
     */
    public function update(UpdateSeverityRequest $request, Severity $severity): JsonResponse
    {
        $duplicate = Severity::duplicate($request->data, $severity->id)->first();
        if ($duplicate) {
            return response()->json(['message' => __('notification.duplicated')], 409);
        }
        if ($request->status['id'] == 'active') {
            if ($severity->trashed()) {
                $severity->restore();
            }
        } else {
            $severity->delete();
        }

        $severity->update($request->data);
        $severity->status = $request->status['id'];
        $severity->save();

        return response()->json(__('notification.updated', ['attribute' => 'severity']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Severity  $severity
     * @return JsonResponse
     */
    public function destroy(Severity $severity): JsonResponse
    {
        $severity->delete();
        $severity->status = 'inactive';
        $severity->save();

        return response()->json(__('notification.inactivated', ['attribute' => 'severity']));
    }
}
