<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreResolutionRequest;
use App\Http\Requests\UpdateResolutionRequest;
use App\Models\Resolution;

class ResolutionController extends Controller
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
     * @param  \App\Http\Requests\StoreResolutionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreResolutionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Resolution  $resolution
     * @return \Illuminate\Http\Response
     */
    public function show(Resolution $resolution)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Resolution  $resolution
     * @return \Illuminate\Http\Response
     */
    public function edit(Resolution $resolution)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateResolutionRequest  $request
     * @param  \App\Models\Resolution  $resolution
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateResolutionRequest $request, Resolution $resolution)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Resolution  $resolution
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resolution $resolution)
    {
        //
    }
}
