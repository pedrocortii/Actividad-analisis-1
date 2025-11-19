<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVehiculoRequest;
use App\Http\Requests\UpdateVehiculoRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\MarcaVehiculo;

class VehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehiculos = Vehiculo::all();
        return view ('vehiculos.index', compact('vehiculos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $marcas = MarcaVehiculo::all();
        return view ('vehiculos.create', compact('marcas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreVehiculoRequest  $request
     * @return \Illuminate\Http\Response
     * use
     */
    public function store(StoreVehiculoRequest $request)
    {
        $vehiculo = new Vehiculo();
        $vehiculo->patente = $request->input('patente');
        $vehiculo->marca_vehiculo_id = $request->input('marca_vehiculo_id');
        $vehiculo->modelo = $request->input('modelo');
        $vehiculo->año = $request->input('año');
        $vehiculo->vtv = $request->input('vtv');
        $vehiculo->estado = $request->input('estado');
        $vehiculo->foto = $request->input('foto', null);
            if ($request->hasFile('foto')) { 
                $file = $request->file('foto');
                $fileName = $file->getClientOriginalName();
                $path = Storage::disk('public')->putFileAs('images/vehiculos', $file, $fileName);
                $vehiculo->foto = $path; 
}
        $vehiculo->save();

        return redirect()->route('vehiculos.index')->with('success', 'Vehiculo creado exitosamente.');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehiculo  $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function show(Vehiculo $vehiculo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vehiculo  $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehiculo $vehiculo)
    {
        $vehiculo = Vehiculo::find($vehiculo->id);
        $marcas = MarcaVehiculo::all();
        return view('vehiculos.edit', compact('vehiculo', 'marcas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVehiculoRequest  $request
     * @param  \App\Models\Vehiculo  $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVehiculoRequest $request, Vehiculo $vehiculo)
    {
        $vehiculo->patente = $request->input('patente');
        $vehiculo->marca_vehiculo_id = $request->input('marca_vehiculo_id');
        $vehiculo->modelo = $request->input('modelo');
        $vehiculo->año = $request->input('año');
        $vehiculo->estado = $request->input('estado');
        $vehiculo->foto = $request->input('foto');
        $vehiculo->vtv = $request->input('vtv');
        $vehiculo->save();

        return redirect()->route('vehiculos.index')->with('success', 'Vehiculo actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehiculo  $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehiculo $vehiculo)
    {
        $vehiculo->delete();
        return redirect()->route('vehiculos.index')
        ->with('success', 'Vehiculo eliminado exitosamente.');
    }
}
