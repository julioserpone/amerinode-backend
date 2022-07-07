<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBranchRequest;
use App\Http\Requests\UpdateBranchRequest;
use App\Models\Branch;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class BranchController extends Controller
{
    /**
     * Return a listing of the resource.
     *
     * @return Builder[]|Collection
     */
    public function index(): Collection|array
    {
        return Branch::with(['company','country'])->withTrashed()->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBranchRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBranchRequest $request)
    {
        //
    }

    /**
     * Return the specified resource.
     *
     * @param  Branch  $branch
     * @return Response|Branch
     */
    public function show(Branch $branch): Response|Branch
    {
        return $branch->load(['country','company']);
    }

    /**
     * Return the specified resource for editing
     *
     * @param  Branch  $branch
     * @return Response|Branch
     */
    public function edit(Branch $branch): Response|Branch
    {
        return $branch->load(['country','company']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateBranchRequest  $request
     * @param  Branch  $branch
     * @return JsonResponse
     */
    public function update(UpdateBranchRequest $request, Branch $branch): JsonResponse
    {
        return response()->json($request->country, 500);
        $duplicate = Branch::duplicate($request->country, $request->company, $branch->id)->first();
        if ($duplicate) {
            return response()->json(['message' => __('notification.duplicated')], 409);
        }
        if ($request->status['id'] == 'active') {
            if ($branch->trashed()) {
                $branch->restore();
            }
        } else {
            $branch->delete();
        }
        //$branch->update($request->technology);
        $branch->status = $request->status['id'];
        $branch->save();

        return response()->json(__('notification.updated', ['attribute' => 'technology']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Branch  $branch
     * @return JsonResponse
     */
    public function destroy(Branch $branch): JsonResponse
    {
        $branch->delete();
        $branch->status = 'inactive';
        $branch->save();

        return response()->json(__('notification.inactivated', ['attribute' => 'branch']));
    }
}
