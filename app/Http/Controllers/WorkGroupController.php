<?php

namespace App\Http\Controllers;

use App\Models\WorkGroup;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWorkGroupRequest;
use App\Http\Requests\UpdateWorkGroupRequest;
use Illuminate\Http\Request; // Importar Request
use App\Models\Vehiculo; // Importar Vehiculo
use App\Models\Employee; // Importar Employee
use Barryvdh\DomPDF\Facade\Pdf;


class WorkGroupController extends Controller
{
    /**
     * Muestra una lista de todos los grupos de trabajo.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('pdf')) {
            return $this->exportPDF($request);
        }

        $query = WorkGroup::with('employees', 'vehiculo');

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('vehiculo_id')) {
            $query->where('vehiculo_id', $request->vehiculo_id);
        }

        if ($request->filled('employee_id')) {
            $query->whereHas('employees', function ($q) use ($request) {
                $q->where('employee_id', $request->employee_id);
            });
        }

        $workGroups = $query->paginate(10);
        $vehiculos = Vehiculo::all(); // Necesitamos los vehículos para el filtro en la vista
        $employees = Employee::all(); // Necesitamos los empleados para el filtro en la vista

        return view('work_groups.index', compact('workGroups', 'vehiculos', 'employees'));
    }
    /**
     * Muestra el formulario para crear un nuevo recurso.
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
     * Almacena un recurso recién creado en el almacenamiento.
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
        
        // Actualizar estado del vehículo si fue asignado
        if ($request->vehiculo_id) {
            $vehiculo = Vehiculo::find($request->vehiculo_id);
            if ($vehiculo) {
                $vehiculo->estado = 'ocupado';
                $vehiculo->save();
            }
        }

        return redirect()->route('work-groups.index')->with('success', 'Grupo de trabajo creado exitosamente.');
    }
    /**
     * Muestra el recurso especificado.
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
     * Muestra el formulario para editar el recurso especificado.
     *
     * @param  \App\Models\WorkGroup  $workGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(WorkGroup $workGroup)
    {
        
        $gruposDisponibles = WorkGroup::withCount(['activeWorkOrders'])
            ->having('active_work_orders_count', '<', 3)
            ->get();
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
     * Actualiza el recurso especificado en el almacenamiento.
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

        $oldVehiculoId = $workGroup->vehiculo_id; // Guardar el ID del vehículo anterior
        
        $workGroup->update([
            'name' => $request->name,
            'vehiculo_id' => $request->vehiculo_id,
        ]);
        
        $workGroup->employees()->sync($request->employee_ids ?? []);
        
        // Lógica para actualizar el estado de los vehículos
        if ($oldVehiculoId && $oldVehiculoId != $request->vehiculo_id) {
            // Si se desasignó o cambió de vehículo, el anterior vuelve a disponible
            $oldVehiculo = Vehiculo::find($oldVehiculoId);
            if ($oldVehiculo) {
                $oldVehiculo->estado = 'disponible';
                $oldVehiculo->save();
            }
        }

        if ($request->vehiculo_id) {
            // Si se asignó un nuevo vehículo o se mantuvo el mismo, se marca como ocupado
            $newVehiculo = Vehiculo::find($request->vehiculo_id);
            if ($newVehiculo) {
                $newVehiculo->estado = 'ocupado';
                $newVehiculo->save();
            }
        }

        return redirect()->route('work-groups.index')->with('success', 'Grupo de trabajo actualizado exitosamente.');
    
    }
    /**
     * Elimina el recurso especificado del almacenamiento.
     *
     * @param  \App\Models\WorkGroup  $workGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkGroup $workGroup)
    {
        // Antes de eliminar el grupo, si tiene un vehículo, ponerlo como disponible
        if ($workGroup->vehiculo_id) {
            $vehiculo = Vehiculo::find($workGroup->vehiculo_id);
            if ($vehiculo) {
                $vehiculo->estado = 'disponible';
                $vehiculo->save();
            }
        }
        $workGroup->delete();
        return redirect()->route('work-groups.index')->with('success', 'Grupo de trabajo eliminado exitosamente.');
    }

    /**
     * Exporta los grupos de trabajo a un archivo PDF.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function exportPDF(Request $request)
    {
        $query = WorkGroup::with('employees', 'vehiculo');

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('vehiculo_id')) {
            $query->where('vehiculo_id', $request->vehiculo_id);
        }

        if ($request->filled('employee_id')) {
            $query->whereHas('employees', function ($q) use ($request) {
                $q->where('employee_id', $request->employee_id);
            });
        }

        $workGroups = $query->get();
        
        $pdf = Pdf::loadView('work_groups.pdf', compact('workGroups'))
                  ->setPaper('a4', 'landscape');
        
        return $pdf->download('work_groups.pdf');
    }
}