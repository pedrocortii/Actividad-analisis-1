<?php

namespace App\Http\Controllers;

use App\Models\Movil;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMovilRequest;
use App\Http\Requests\UpdateMovilRequest;
use App\Models\Vehiculo;
use Illuminate\Http\Request; // Importa la clase Request

class MovilController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $moviles = Movil::all();
        return view('movil.index', compact('moviles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('movil.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMovilRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMovilRequest $request)
    {
        $movil = new Movil();
        $movil->nombre = $request->nombre;
        $movil->codigo = $request->codigo;
        $movil->zona_asignada = $request->zona_asignada;
        $movil->estado = $request->estado;

        $movil->save();
        return redirect()->route('movil.index')->with('success', 'Móvil creado exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Movil  $movil
     * @return \Illuminate\Http\Response
     */
    public function show(Movil $movil)
    {
        // Se carga el móvil con sus vehículos
        $movil->load('vehiculos');
        return view('movil.show', compact('movil'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Movil  $movil
     * @return \Illuminate\Http\Response
     */
    public function edit(Movil $movil)
    {
        return view('movil.edit', compact('movil'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMovilRequest  $request
     * @param  \App\Models\Movil  $movil
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMovilRequest $request, Movil $movil)
    {
        $movil->nombre = $request->nombre;
        $movil->codigo = $request->codigo;
        $movil->zona_asignada = $request->zona_asignada;
        $movil->estado = $request->estado;
        $movil->save();
        return redirect()->route('movil.index')->with('success', 'Móvil actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movil  $movil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movil $movil)
    {
        $movil->delete();
        return redirect()->route('movil.index')->with('success', 'Móvil eliminado exitosamente.');
    }

    /**
     * Muestra el formulario para asignar un vehículo.
     *
     * @return \Illuminate\Http\Response
     */
    public function asignarForm()
{
    $moviles = Movil::all();
    $vehiculos = Vehiculo::whereNull('movil_id')->get();
    
    // Error: compact('vehiculosSinAsignar') → debería ser compact('vehiculosDisponibles')
    return view('movil.asignar', compact('moviles', 'vehiculosDisponibles'));
}

    /**
     * Asigna un vehículo a un móvil.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function asignarVehiculo(Request $request)
    {
        $request->validate([
            'movil_id' => 'required|exists:moviles,id',
            'vehiculo_id' => 'required|exists:vehiculos,id',
        ]);

        $vehiculo = Vehiculo::findOrFail($request->vehiculo_id);
        $vehiculo->movil()->associate(Movil::findOrFail($request->movil_id));
        $vehiculo->save();

        return redirect()->route('movil.index')->with('success', 'Vehículo asignado correctamente.');
    }
}