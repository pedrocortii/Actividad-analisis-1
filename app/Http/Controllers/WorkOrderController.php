<?php

namespace App\Http\Controllers;

use App\Models\WorkOrder;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWorkOrderRequest;
use App\Http\Requests\UpdateWorkOrderRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\User; // Importar User
use App\Models\WorkGroup; // Importar WorkGroup
use App\Models\Status;
use App\Models\Workflow;
use Barryvdh\DomPDF\Facade\Pdf;

class WorkOrderController extends Controller
{
    /**
     * Muestra una lista de todas las órdenes de trabajo.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('pdf')) {
            return $this->exportPDF($request);
        }

        $query = WorkOrder::with('user', 'workGroup', 'status');

        if ($request->filled('codigo')) {
            $query->where('codigo', 'like', '%' . $request->codigo . '%');
        }

        if ($request->filled('descripcion')) {
            $query->where('descripcion', 'like', '%' . $request->descripcion . '%');
        }

        if ($request->filled('estado')) {
            $query->whereHas('status', function ($q) use ($request) {
                $q->where('name', $request->estado);
            });
        }

        if ($request->filled('prioridad')) {
            $query->where('prioridad', $request->prioridad);
        }

        if ($request->filled('fecha_solicitud_desde')) {
            $query->whereDate('fecha_solicitud', '>=', $request->fecha_solicitud_desde);
        }

        if ($request->filled('fecha_solicitud_hasta')) {
            $query->whereDate('fecha_solicitud', '<=', $request->fecha_solicitud_hasta);
        }
        
        if ($request->filled('work_group_id')) {
            $query->where('work_group_id', $request->work_group_id);
        }

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        $workOrders = $query->paginate(10);
        $users = User::all(); // Necesitamos los usuarios para el filtro en la vista
        $workGroups = WorkGroup::all(); // Necesitamos los grupos de trabajo para el filtro en la vista
        $statuses = Status::all(); // Necesitamos los estados para el filtro en la vista

        return view('work_orders.index', compact('workOrders', 'users', 'workGroups', 'statuses'));
    }

    /**
     * Muestra el formulario para crear una nueva orden de trabajo.
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
     * Almacena una nueva orden de trabajo en la base de datos.
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
        $workOrder->status_id = Status::where('name', 'Pendiente de Asignacion')->first()->id; // Asignar status_id
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
     * Muestra la orden de trabajo especificada.
     *
     * @param  \App\Models\WorkOrder  $workOrder
     * @return \Illuminate\Http\Response
     */
    public function show(WorkOrder $workOrder)
    {
        return view('work_orders.show', compact('workOrder'));
    }

    /**
     * Muestra el formulario para editar la orden de trabajo especificada.
     *
     * @param  \App\Models\WorkOrder  $workOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(WorkOrder $workOrder)
    {
        // Lógica para que el Jefe edite/asigne la orden
        // Mostrar grupos con menos de 3 órdenes activas y el grupo actualmente asignado
        $gruposDisponibles = WorkGroup::withCount('activeWorkOrders')
            ->having('active_work_orders_count', '<', 3)
            ->get();

        if ($workOrder->work_group_id && !$gruposDisponibles->contains('id', $workOrder->work_group_id)) {
            $grupoActual = WorkGroup::find($workOrder->work_group_id);
            if ($grupoActual) {
                $gruposDisponibles->push($grupoActual);
            }
        }

        return view('work_orders.edit', compact('workOrder', 'gruposDisponibles'));
    }

    /**
     * Actualiza la orden de trabajo especificada en la base de datos.
     *
     * @param  \App\Http\Requests\UpdateWorkOrderRequest  $request
     * @param  \App\Models\WorkOrder  $workOrder
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWorkOrderRequest $request, WorkOrder $workOrder)
    {
        // Lógica para que el Jefe actualice y asigne
        $oldWorkGroupId = $workOrder->work_group_id;

        $workOrder->descripcion = $request->input('descripcion');
        $workOrder->direccion_de_servicio = $request->input('direccion_de_servicio');
        $workOrder->prioridad = $request->input('prioridad');
        $workOrder->fecha_programada = $request->input('fecha_programada');
        
        // Aquí está la lógica de asignación
        $workOrder->work_group_id = $request->input('work_group_id');
        
        // Si se asigna un grupo y el estado es 'Pendiente de Asignacion', cambiar a 'Asignado'
        if ($request->filled('work_group_id') && $workOrder->status->name === 'Pendiente de Asignacion') {
            $assignedStatus = Status::where('name', 'Asignado')->first();
            if ($assignedStatus) {
                $workOrder->status_id = $assignedStatus->id;
            }
        }

        // Marcar el nuevo grupo de trabajo como ocupado si se ha asignado o cambiado
        if ($request->filled('work_group_id')) {
            $newWorkGroup = WorkGroup::find($request->input('work_group_id'));
            if ($newWorkGroup) {
                $newWorkGroup->status = 'ocupado';
                $newWorkGroup->save();
            }
        }

        // Si el grupo de trabajo ha cambiado, marcar el antiguo como disponible
        if ($oldWorkGroupId && $oldWorkGroupId != $request->input('work_group_id')) {
            $oldWorkGroup = WorkGroup::find($oldWorkGroupId);
            if ($oldWorkGroup) {
                $oldWorkGroup->status = 'disponible';
                $oldWorkGroup->save();
            }
        }

        $workOrder->save();

        return redirect()->route('work-orders.index')->with('success', 'Orden de trabajo actualizada exitosamente.');
    }

    /**
     * Elimina la orden de trabajo especificada de la base de datos.
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
            'estado' => ['required', 'string'], // Validaremos la transición usando puedeCambiarA
        ]);

        $nuevoEstadoName = $request->input('estado');

        if (!$workOrder->puedeCambiarA($nuevoEstadoName)) {
            return redirect()->back()->withErrors(['estado' => 'Transición de estado no permitida.']);
        }

        $newStatus = Status::where('name', $nuevoEstadoName)->first();
        if ($newStatus) {
            $workOrder->status_id = $newStatus->id;
        }
        $workOrder->save();

        // Si el estado es 'Completado' o 'Rechazado', liberar el grupo de trabajo
        if (in_array($nuevoEstadoName, ['Completado', 'Rechazado'])) {
            if ($workOrder->workGroup) {
                $workOrder->workGroup->status = 'disponible';
                $workOrder->workGroup->save();
            }
        }

        return redirect()->route('work-orders.index')->with('success', 'Estado de la orden de trabajo actualizado exitosamente.');
    }

    /**
     * Exporta las órdenes de trabajo a un archivo PDF.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function exportPDF(Request $request)
    {
        $query = WorkOrder::with('user', 'workGroup', 'status');

        if ($request->filled('codigo')) {
            $query->where('codigo', 'like', '%' . $request->codigo . '%');
        }

        if ($request->filled('descripcion')) {
            $query->where('descripcion', 'like', '%' . $request->descripcion . '%');
        }

        if ($request->filled('estado')) {
            $query->whereHas('status', function ($q) use ($request) {
                $q->where('name', $request->estado);
            });
        }

        if ($request->filled('prioridad')) {
            $query->where('prioridad', $request->prioridad);
        }

        if ($request->filled('fecha_solicitud_desde')) {
            $query->whereDate('fecha_solicitud', '>=', $request->fecha_solicitud_desde);
        }

        if ($request->filled('fecha_solicitud_hasta')) {
            $query->whereDate('fecha_solicitud', '<=', $request->fecha_solicitud_hasta);
        }
        
        if ($request->filled('work_group_id')) {
            $query->where('work_group_id', $request->work_group_id);
        }

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        $workOrders = $query->get();
        
        $pdf = Pdf::loadView('work_orders.pdf', compact('workOrders'))
                  ->setPaper('a4', 'landscape');
        
        return $pdf->download('work_orders.pdf');
    }
}