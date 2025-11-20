<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Skill;
use Illuminate\Http\Request; // Importar Request
use Barryvdh\DomPDF\Facade\Pdf;

class EmployeeController extends Controller
{
    /**
     * Muestra una lista de todos los empleados.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('pdf')) {
            return $this->exportPDF($request);
        }

        $query = Employee::query();

        if ($request->filled('nombre')) {
            $query->where('nombre', 'like', '%' . $request->nombre . '%');
        }

        if ($request->filled('apellido')) {
            $query->where('apellido', 'like', '%' . $request->apellido . '%');
        }

        if ($request->filled('dni')) {
            $query->where('dni', $request->dni);
        }

        if ($request->filled('rol')) {
            $query->where('rol', $request->rol);
        }

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        if ($request->filled('skill_id')) {
            $query->whereHas('skills', function ($q) use ($request) {
                $q->where('skill_id', $request->skill_id);
            });
        }

        $employees = $query->paginate(10);
        $skills = Skill::all(); // Necesitamos las habilidades para el filtro en la vista

        return view('employees.index', compact('employees', 'skills'));
    }

    /**
     * Muestra el formulario para crear un nuevo recurso.
     *
     * @return \Illuminate\Http\Response
     */
public function create()
{
    $skills = Skill::all();
    return view('employees.create', compact('skills'));
}

    /**
     * Almacena un recurso recién creado en el almacenamiento.
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
     * Muestra el recurso especificado.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Muestra el formulario para editar el recurso especificado.
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
     * Actualiza el recurso especificado en el almacenamiento.
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
     * Elimina el recurso especificado del almacenamiento.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Empleado eliminado exitosamente.');
    }

    /**
     * Exporta los empleados a un archivo PDF.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function exportPDF(Request $request)
    {
        $query = Employee::query();

        if ($request->filled('nombre')) {
            $query->where('nombre', 'like', '%' . $request->nombre . '%');
        }

        if ($request->filled('apellido')) {
            $query->where('apellido', 'like', '%' . $request->apellido . '%');
        }

        if ($request->filled('dni')) {
            $query->where('dni', $request->dni);
        }

        if ($request->filled('rol')) {
            $query->where('rol', $request->rol);
        }

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        if ($request->filled('skill_id')) {
            $query->whereHas('skills', function ($q) use ($request) {
                $q->where('skill_id', $request->skill_id);
            });
        }

        $employees = $query->get();
        
        $pdf = Pdf::loadView('employees.pdf', compact('employees'))
                  ->setPaper('a4', 'landscape');
        
        return $pdf->download('employees.pdf');
    }
}
