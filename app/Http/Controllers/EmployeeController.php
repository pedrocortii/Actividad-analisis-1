<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;

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
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEmployeeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeRequest $request)
    {
        $employee = new Employee();
        $employee->nombre = $request->input('nombre');
        $employee->apellido = $request->input('apellido');
        $employee->dni = $request->input('dni');
        $employee->telefono = $request->input('telefono');
        $employee->email = $request->input('email');
        $employee->direccion = $request->input('direccion');
        $employee->rol = $request->input('rol');
        $employee->licencia_conducir = $request->input('licencia_conducir');
        $employee->fecha_contratacion = $request->input('fecha_contratacion');
        $employee->estado = $request->input('estado');
        $employee->save();
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
        return view('employees.edit', compact('employee'));
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
        $employee->nombre = $request->input('nombre');
        $employee->apellido = $request->input('apellido');
        $employee->dni = $request->input('dni');
        $employee->telefono = $request->input('telefono');
        $employee->email = $request->input('email');
        $employee->direccion = $request->input('direccion');
        $employee->rol = $request->input('rol');
        $employee->licencia_conducir = $request->input('licencia_conducir');
        $employee->fecha_contratacion = $request->input('fecha_contratacion');
        $employee->estado = $request->input('estado');
        $employee->save();
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
