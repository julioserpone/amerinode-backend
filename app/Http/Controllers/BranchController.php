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
        return Branch::listAllOrdered()->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreBranchRequest  $request
     * @return JsonResponse
     */
    public function store(StoreBranchRequest $request): JsonResponse
    {
        $duplicate = Branch::duplicate($request->country, $request->company)->first();

        if ($duplicate) {
            return response()->json(['message' => __('notification.duplicated')], 409);
        }

        Branch::create([
            'country_id' => $request->country['id'],
            'company_id' => $request->company['id'],
            'status' => $request->status['id'],
        ]);

        return response()->json(__('notification.created', ['attribute' => 'branch']));
    }

    /**
     * Return the specified resource.
     *
     * @param  Branch  $branch
     * @return Response|Branch
     */
    public function show(Branch $branch): Response|Branch
    {
        return $branch->load(['country', 'company']);
    }

    /**
     * Return the specified resource for editing
     *
     * @param  Branch  $branch
     * @return Response|Branch
     */
    public function edit(Branch $branch): Response|Branch
    {
        return $branch->load(['country', 'company']);
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
        $branch->update([
            'country_id' => $request->country['id'],
            'company_id' => $request->company['id'],
        ]);
        $branch->status = $request->status['id'];
        $branch->save();

        return response()->json(__('notification.updated', ['attribute' => 'branch']));
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
