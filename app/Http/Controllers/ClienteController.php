<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{
    /**
     * Muestra el panel principal del cliente con sus órdenes de trabajo.
     */
    public function index()
    {
        $user = Auth::user();
        
        // Asumimos que las órdenes de trabajo tienen una relación con el usuario que las creó.
        // Necesitaremos añadir 'user_id' a la tabla 'work_orders' para que esto funcione.
        $workOrders = \App\Models\WorkOrder::where('user_id', $user->id)
                                             ->orderBy('fecha_solicitud', 'desc')
                                             ->get();

        return view('clientes.index', compact('user', 'workOrders'));
    }
}
