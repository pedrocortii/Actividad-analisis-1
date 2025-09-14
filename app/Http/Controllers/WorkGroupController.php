<?php

namespace App\Http\Controllers;

use App\Models\WorkGroup;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWorkGroupRequest;
use App\Http\Requests\UpdateWorkGroupRequest;

class WorkGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
{
    $workGroups = WorkGroup::with('employees')->paginate(10);
    return view('work_groups.index', compact('workGroups'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    $vehiculos = \App\Models\Vehiculo::all();
    $employees = \App\Models\Employee::all();
    return view('work_groups.create', compact('vehiculos', 'employees'));
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreWorkGroupRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWorkGroupRequest $request)
    {
        //dd($request->all());
        $workGroup = WorkGroup::create([
            'name' => $request->name,
            'vehiculo_id' => $request->vehiculo_id,
        ]);

        $workGroup->employees()->attach($request->employee_ids);
        
        $workGroup->save();
        
        return redirect()->route('work-groups.index')->with('success', 'Grupo de trabajo creado exitosamente.');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WorkGroup  $workGroup
     * @return \Illuminate\Http\Response
     */
    public function show(WorkGroup $workGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WorkGroup  $workGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(WorkGroup $workGroup)
    {
        $vehiculos = \App\Models\Vehiculo::all();
        $employees = \App\Models\Employee::all();
        return view('work_groups.edit', compact('workGroup', 'vehiculos', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWorkGroupRequest  $request
     * @param  \App\Models\WorkGroup  $workGroup
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWorkGroupRequest $request, WorkGroup $workGroup)
    {
        $workGroup->update([
        'name' => $request->name,
        'vehiculo_id' => $request->vehiculo_id,
    ]);

    // Sincroniza empleados (actualiza la lista)
    if ($request->has('employee_ids')) {
        $workGroup->employees()->sync($request->employee_ids);
    }

    return response()->json($workGroup->load('employees', 'vehiculo'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WorkGroup  $workGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkGroup $workGroup)
    {
        $workGroup->delete();
        return redirect()->route('work-groups.index')->with('success', 'Grupo de trabajo eliminado exitosamente.');
    }
}
