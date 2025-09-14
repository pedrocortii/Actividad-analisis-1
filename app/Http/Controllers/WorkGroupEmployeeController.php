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
    //listar todas las relaciones
    public function index()
    {
        return response()->json(WorkGroupEmployee::all());
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

    //crear una nueva relacion
    public function store(StoreWorkGroupEmployeeRequest $request)
    {
        $relation = WorkGroupEmployee::create([
            'work_group_id' => $request->work_group_id,
            'employee_id' => $request->employee_id,
        ]);
        return response()->json($relation, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WorkGroupEmployee  $workGroupEmployee
     * @return \Illuminate\Http\Response
     */

    //mostrar una relacion especifica
    public function show(WorkGroupEmployee $workGroupEmployee)
    {
        return response()->json($workGroupEmployee);
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
    //actualizar una relacion
    public function update(UpdateWorkGroupEmployeeRequest $request, WorkGroupEmployee $workGroupEmployee)
    {
        $workGroupEmployee->update($request->all());
        return response()->json($workGroupEmployee);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WorkGroupEmployee  $workGroupEmployee
     * @return \Illuminate\Http\Response
     */

    //Eliminamos una relacion
    public function destroy(WorkGroupEmployee $workGroupEmployee)
    {
        $workGroupEmployee->delete();
        return response()->json(['message' => 'Relación eliminada']);
    }
}
