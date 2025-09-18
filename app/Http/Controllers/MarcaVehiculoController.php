<?php

namespace App\Http\Controllers;

use App\Models\MarcaVehiculo;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMarcaVehiculoRequest;
use App\Http\Requests\UpdateMarcaVehiculoRequest;

class MarcaVehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marcaVehiculos = MarcaVehiculo::all();
        return view ('marca_vehiculo.index', compact('marcaVehiculos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('marca_vehiculo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMarcaVehiculoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMarcaVehiculoRequest $request)
    {
        $marcaVehiculo = new MarcaVehiculo();
        $marcaVehiculo->nombre = $request->input('nombre');
        $marcaVehiculo->save();

        return redirect()->route('marcaVehiculos.index')->with('success', 'Marca de Vehiculo creada exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MarcaVehiculo  $marcaVehiculo
     * @return \Illuminate\Http\Response
     */
    public function show(MarcaVehiculo $marcaVehiculo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MarcaVehiculo  $marcaVehiculo
     * @return \Illuminate\Http\Response
     */
    public function edit(MarcaVehiculo $marcaVehiculo)
    {
        return view('marca_vehiculo.edit', compact('marcaVehiculo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMarcaVehiculoRequest  $request
     * @param  \App\Models\MarcaVehiculo  $marcaVehiculo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMarcaVehiculoRequest $request, MarcaVehiculo $marcaVehiculo)
    {
        $marcaVehiculo->nombre = $request->input('nombre');
        $marcaVehiculo->save();

        return redirect()->route('marcaVehiculos.index')->with('success', 'Marca de Vehiculo actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MarcaVehiculo  $marcaVehiculo
     * @return \Illuminate\Http\Response
     */
    public function destroy(MarcaVehiculo $marcaVehiculo)
    {
        $marcaVehiculo->delete();
        return redirect()->route('marcaVehiculos.index')
            ->with('success', 'Marca de Vehiculo eliminada exitosamente.');
    }
}
