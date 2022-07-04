<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTechnologyRequest;
use App\Http\Requests\UpdateTechnologyRequest;
use App\Models\Technology;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class TechnologyController extends Controller
{
    /**
     * Return a listing of the resource.
     *
     * @return Builder[]|Collection
     */
    public function index(): Collection|array
    {
        return Technology::withTrashed()->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreTechnologyRequest  $request
     * @return JsonResponse
     */
    public function store(StoreTechnologyRequest $request): JsonResponse
    {
        $technology = Technology::create([
            'description' => $request->technology['description'],
        ]);

        $technology->status = $request->status['id'];
        $technology->save();

        return response()->json(__('notification.created', ['attribute' => 'technology']));
    }

    /**
     * Display the specified resource.
     *
     * @param  Technology  $technology
     * @return Response|Technology
     */
    public function show(Technology $technology): Response|Technology
    {
        return $technology;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Technology  $technology
     * @return Response|Technology
     */
    public function edit(Technology $technology): Response|Technology
    {
        return $technology;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateTechnologyRequest  $request
     * @param  Technology  $technology
     * @return JsonResponse
     */
    public function update(UpdateTechnologyRequest $request, Technology $technology): JsonResponse
    {
        if ($request->status['id'] == 'active') {
            if ($technology->trashed()) {
                $technology->restore();
            }
        } else {
            $technology->delete();
        }
        $technology->update($request->technology);
        $technology->status = $request->status['id'];
        $technology->save();

        return response()->json(__('notification.updated', ['attribute' => 'technology']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Technology  $technology
     * @return JsonResponse
     */
    public function destroy(Technology $technology): JsonResponse
    {
        $technology->delete();
        $technology->status = 'inactive';
        $technology->save();

        return response()->json(__('notification.inactivated', ['attribute' => 'technology']));
    }
}
