<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Skill;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
{
    $employees = Employee::all();
    return view('employees.index', compact('employees'));
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
public function create()
{
    $skills = Skill::all();
    return view('employees.create', compact('skills'));
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEmployeeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeRequest $request)
{
    $employee = Employee::create($request->only([
        'nombre', 'apellido', 'dni', 'telefono', 'email', 'direccion', 
        'rol', 'licencia_conducir', 'fecha_contratacion', 'estado'
    ]));

    // Asignar skills si vienen en el request
    if ($request->has('skills')) {
        $employee->skills()->sync($request->skills); 
    }

    return redirect()->route('employees.index')->with('success', 'Empleado creado exitosamente.');
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
{
    $skills = Skill::all();
    return view('employees.edit', compact('employee', 'skills'));
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEmployeeRequest  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response 
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
{
    $employee->update($request->only([
        'nombre', 'apellido', 'dni', 'telefono', 'email', 'direccion', 
        'rol', 'licencia_conducir', 'fecha_contratacion', 'estado'
    ]));

    if ($request->has('skills')) {
        $employee->skills()->sync($request->skills);
    }

    return redirect()->route('employees.index')->with('success', 'Empleado actualizado exitosamente.');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Empleado eliminado exitosamente.');
    }
}
