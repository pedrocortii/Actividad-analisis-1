<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVehiculoRequest;
use App\Http\Requests\UpdateVehiculoRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\MarcaVehiculo;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class VehiculoController extends Controller
{
    /**
     * Muestra una lista de todos los vehículos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('pdf')) {
            return $this->exportPDF($request);
        }

        $query = Vehiculo::query();

        if ($request->filled('marca_vehiculo_id')) {
            $query->where('marca_vehiculo_id', $request->marca_vehiculo_id);
        }

        if ($request->filled('modelo')) {
            $query->where('modelo', 'like', '%' . $request->modelo . '%');
        }

        if ($request->filled('año')) {
            $query->where('año', $request->año);
        }

        if ($request->filled('estado')) {
            // Convertir el valor del request a minúsculas y quitar espacios
            $estadoFiltrado = strtolower(trim($request->input('estado')));
            $query->whereRaw("REPLACE(LOWER(TRIM(estado)), ' ', '_') = ?", [$estadoFiltrado]);
        }

        $vehiculos = $query->paginate(10); // Paginación de 10 vehículos por página
        $marcas = MarcaVehiculo::all(); // Obtener todas las marcas para el filtro

        return view('vehiculos.index', compact('vehiculos', 'marcas'));
    }

    /**
     * Muestra el formulario para crear un nuevo recurso.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $marcas = MarcaVehiculo::all();
        return view ('vehiculos.create', compact('marcas'));
    }

    /**
     * Almacena un recurso recién creado en el almacenamiento.
     *
     * @param  \App\Http\Requests\StoreVehiculoRequest  $request
     * @return \Illuminate\Http\Response
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
     * Muestra el recurso especificado.
     *
     * @param  \App\Models\Vehiculo  $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function show(Vehiculo $vehiculo)
    {
        //
    }

    /**
     * Muestra el formulario para editar el recurso especificado.
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
     * Actualiza el recurso especificado en el almacenamiento.
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
     * Elimina el recurso especificado del almacenamiento.
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

    /**
     * Exporta los vehículos a un archivo PDF.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function exportPDF(Request $request)
    {
        $desde = $request->input('desde');
        $hasta = $request->input('hasta');
        $marca_vehiculo_id = $request->input('marca_vehiculo_id');
        
        $query = Vehiculo::with('marca');
        
        if ($desde && $hasta) {
            $query->whereDate('created_at', '>=', $desde)
                  ->whereDate('created_at', '<=', $hasta);
        }
        
        if ($marca_vehiculo_id) {
            $query->where('marca_vehiculo_id', $marca_vehiculo_id);
            $marca = MarcaVehiculo::find($marca_vehiculo_id);
        } else {
            $marca = null;
        }
        
        $vehiculos = $query->orderBy('created_at', 'desc')->get();
        
        $pdf = Pdf::loadView('vehiculos.pdf', compact('vehiculos', 'marca', 'desde', 'hasta'))
                  ->setPaper('a4', 'landscape');
        
        return $pdf->download('vehiculos.pdf');
    }
}