<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CompanyController extends Controller
{
    /**
     * Return a listing of the resource.
     *
     * @return Builder[]|Collection
     */
    public function index(): Collection|array
    {
        return Company::withTrashed()->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreCompanyRequest  $request
     * @return JsonResponse
     */
    public function store(StoreCompanyRequest $request): JsonResponse
    {
        $company = Company::create([
            'description' => $request->company['description'],
        ]);

        $company->status = $request->status['id'];
        $company->save();

        return response()->json(__('notification.created', ['attribute' => 'company']));
    }

    /**
     * Display the specified resource.
     *
     * @param  Company  $company
     * @return Response|Company
     */
    public function show(Company $company): Response|Company
    {
        return $company;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Company  $company
     * @return Response|Company
     */
    public function edit(Company $company): Response|Company
    {
        return $company;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateCompanyRequest  $request
     * @param  Company  $company
     * @return JsonResponse
     */
    public function update(UpdateCompanyRequest $request, Company $company): JsonResponse
    {
        if ($request->status['id'] == 'active') {
            if ($company->trashed()) {
                $company->restore();
            }
        } else {
            $company->delete();
        }
        $company->update($request->company);
        $company->status = $request->status['id'];
        $company->save();

        return response()->json(__('notification.updated', ['attribute' => 'company']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Company  $company
     * @return JsonResponse
     */
    public function destroy(Company $company): JsonResponse
    {
        $company->delete();
        $company->status = 'inactive';
        $company->save();

        return response()->json(__('notification.deleted', ['attribute' => 'company']));
    }
}
