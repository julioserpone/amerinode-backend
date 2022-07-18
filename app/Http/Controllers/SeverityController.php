<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSeverityRequest;
use App\Http\Requests\UpdateSeverityRequest;
use App\Models\Severity;

class SeverityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSeverityRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSeverityRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Severity  $severity
     * @return \Illuminate\Http\Response
     */
    public function show(Severity $severity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Severity  $severity
     * @return \Illuminate\Http\Response
     */
    public function edit(Severity $severity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSeverityRequest  $request
     * @param  \App\Models\Severity  $severity
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSeverityRequest $request, Severity $severity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Severity  $severity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Severity $severity)
    {
        //
    }
}
