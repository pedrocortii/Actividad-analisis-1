<?php

namespace App\Http\Controllers;

use App\Models\WorkOrder;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWorkOrderRequest;
use App\Http\Requests\UpdateWorkOrderRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class WorkOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workOrders = WorkOrder::all();
        return view('work_orders.index', compact('workOrders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Recuperar las tareas para el menú desplegable de descripción
        $tareas = \App\Models\Tarea::all();
        return view('work_orders.create', compact('tareas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreWorkOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWorkOrderRequest $request)
    {
        // Lógica para que un cliente cree una orden
        $workOrder = new WorkOrder();
        $workOrder->user_id = Auth::id(); // Asignar el ID del usuario autenticado
        $workOrder->descripcion = $request->input('descripcion');
        $workOrder->direccion_de_servicio = $request->input('direccion_de_servicio');
        
        // Valores por defecto al crear
        $workOrder->fecha_solicitud = now();
        $workOrder->estado = 'Pendiente de Asignacion'; // Estado inicial
        $workOrder->prioridad = 'Media'; // Prioridad por defecto
        
        // Generar un código único, por ejemplo:
        $workOrder->codigo = 'ORD-' . strtoupper(uniqid());

        $workOrder->save();
        
        // Si el usuario es un cliente, lo redirigimos a su panel.
        if (auth()->user()->hasRole('cliente')) {
            return redirect()->route('clientes.index')->with('success', 'Tu solicitud de orden de trabajo ha sido enviada exitosamente.');
        }

        return redirect()->route('work-orders.index')->with('success', 'Orden de trabajo creada exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WorkOrder  $workOrder
     * @return \Illuminate\Http\Response
     */
    public function show(WorkOrder $workOrder)
    {
        return view('work_orders.show', compact('workOrder'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WorkOrder  $workOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(WorkOrder $workOrder)
    {
        // Lógica para que el Jefe edite/asigne la orden
        // Necesitamos la lista de grupos de trabajo para mostrarla en un desplegable
        $workGroups = \App\Models\WorkGroup::all();
        
        return view('work_orders.edit', compact('workOrder', 'workGroups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWorkOrderRequest  $request
     * @param  \App\Models\WorkOrder  $workOrder
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWorkOrderRequest $request, WorkOrder $workOrder)
    {
        // Lógica para que el Jefe actualice y asigne
        $workOrder->descripcion = $request->input('descripcion');
        $workOrder->direccion_de_servicio = $request->input('direccion_de_servicio');
        $workOrder->prioridad = $request->input('prioridad');
        $workOrder->fecha_programada = $request->input('fecha_programada');
        
        // Aquí está la lógica de asignación
        $workOrder->work_group_id = $request->input('work_group_id');
        
        // Si se asigna un grupo, cambiamos el estado
        if ($request->filled('work_group_id')) {
            $workOrder->estado = 'Asignado';
        }

        $workOrder->save();

        return redirect()->route('work-orders.index')->with('success', 'Orden de trabajo actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WorkOrder  $workOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkOrder $workOrder)
    {
        //$workOrder->delete();
        //return redirect()->route('work_orders.index')->with('success', 'Orden de trabajo eliminada exitosamente.');
    }

    public function changeEstado(Request $request, WorkOrder $workOrder)
    {
        $request->validate([
            'estado' => ['required',Rule::in(WorkOrder::estados()),],
        ]);

        $nuevoEstado = $request->input('estado');

        if (!$workOrder->puedeCambiarA($nuevoEstado)) {
            return redirect()->back()->withErrors(['estado' => 'Transición de estado no permitida.']);
        }

        $workOrder->estado = $nuevoEstado;
        $workOrder->save();

        return redirect()->route('work-orders.index')->with('success', 'Estado de la orden de trabajo actualizado exitosamente.');
    }
}
