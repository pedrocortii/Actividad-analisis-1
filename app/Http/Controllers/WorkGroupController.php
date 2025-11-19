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
        $vehiculos = \App\Models\Vehiculo::with('marca')
            ->whereDoesntHave('workGroup')
            ->where('estado', 'Disponible')
            ->get();
        // Traer empleados que NO están en ningún grupo
        $employees = \App\Models\Employee::whereDoesntHave('workGroups')
            ->get();
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
        // Validar que ningún empleado esté en otro grupo
        if ($request->employee_ids) {
            foreach ($request->employee_ids as $employeeId) {
                $exists = WorkGroup::whereHas('employees', function($q) use ($employeeId) {
                    $q->where('employee_id', $employeeId);
                })->exists();
                
                if ($exists) {
                    return redirect()->back()
                        ->withErrors(['employee_ids' => 'Uno o más empleados ya están asignados a otro grupo de trabajo.'])
                        ->withInput();
                }
            }
        }

        $workGroup = WorkGroup::create([
            'name' => $request->name,
            'vehiculo_id' => $request->vehiculo_id,
        ]);

        $workGroup->employees()->attach($request->employee_ids ?? []);
        
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
        
        $workGroup->load('employees', 'vehiculo.marca');
        
        return view('work_groups.show', compact('workGroup'));
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WorkGroup  $workGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(WorkGroup $workGroup)
    {
        
        $vehiculos = \App\Models\Vehiculo::with('marca')
            ->where(function($query) use ($workGroup) {
                $query->where(function($subQuery) {
                    $subQuery->where('estado', 'Disponible')
                             ->whereDoesntHave('workGroup');
                })
                ->orWhere('id', $workGroup->vehiculo_id);
            })
            ->get();
        
        $employees = \App\Models\Employee::where(function($q) use ($workGroup) {
            $q->whereDoesntHave('workGroups')
              ->orWhereHas('workGroups', function($sub) use ($workGroup) {
                  $sub->where('work_group_id', $workGroup->id);
              });
        })->get();
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
        
        if ($request->employee_ids) {
            foreach ($request->employee_ids as $employeeId) {
                $exists = WorkGroup::whereHas('employees', function($q) use ($employeeId) {
                    $q->where('employee_id', $employeeId);
                })->where('id', '!=', $workGroup->id)->exists();
                
                if ($exists) {
                    return redirect()->back()
                        ->withErrors(['employee_ids' => 'Uno o más empleados ya están asignados a otro grupo de trabajo.'])
                        ->withInput();
                }
            }
        }

        $workGroup->update([
            'name' => $request->name,
            'vehiculo_id' => $request->vehiculo_id,
        ]);

        
        
        $workGroup->employees()->sync($request->employee_ids ?? []);
        

        return redirect()->route('work-groups.index')->with('success', 'Grupo de trabajo actualizado exitosamente.');
    
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
