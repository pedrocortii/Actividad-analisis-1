<?php

namespace App\Http\Controllers;

use App\Models\WorkGroupEmployee;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWorkGroupEmployeeRequest;
use App\Http\Requests\UpdateWorkGroupEmployeeRequest;

class WorkGroupEmployeeController extends Controller
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
     * @param  \App\Http\Requests\StoreWorkGroupEmployeeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWorkGroupEmployeeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WorkGroupEmployee  $workGroupEmployee
     * @return \Illuminate\Http\Response
     */
    public function show(WorkGroupEmployee $workGroupEmployee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WorkGroupEmployee  $workGroupEmployee
     * @return \Illuminate\Http\Response
     */
    public function edit(WorkGroupEmployee $workGroupEmployee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWorkGroupEmployeeRequest  $request
     * @param  \App\Models\WorkGroupEmployee  $workGroupEmployee
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWorkGroupEmployeeRequest $request, WorkGroupEmployee $workGroupEmployee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WorkGroupEmployee  $workGroupEmployee
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkGroupEmployee $workGroupEmployee)
    {
        //
    }
}
