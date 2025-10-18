<?php

namespace App\Http\Controllers;

use App\Models\WorkOrder;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWorkOrderRequest;
use App\Http\Requests\UpdateWorkOrderRequest;
use Illuminate\Http\Request;
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
        //$workOrders = WorkOrder::all();
        //return view('work_orders.create', compact('workOrders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreWorkOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWorkOrderRequest $request)
    {
        //$workOrder = WorkOrder::create($request->all());
        //return redirect()->route('work_orders.index')->with('success', 'Orden de trabajo creada exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WorkOrder  $workOrder
     * @return \Illuminate\Http\Response
     */
    public function show(WorkOrder $workOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WorkOrder  $workOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(WorkOrder $workOrder)
    {
        //workOrder::all();
        //return view('work_orders.edit', compact('workOrder'));
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
        //$workOrder->update($request->all());
        //return redirect()->route('work_orders.index')->with('success', 'Orden de trabajo actualizada exitosamente.');
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
