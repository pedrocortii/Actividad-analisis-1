@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{__('Crear Nueva Tarea') }}</div>

                <div class="card-body">
                    <form action="{{ route('vehiculos.store') }}" method="POST">
                        @csrf   
                        <div class="form-group">
                            <label for="Patente">Patente</label>
                            <input type="text" class="form-control" id="patente" name="patente" required>
                            <label for="marca_vehiculo_id">Marca</label>
                            <select class="form-control" id="marca_vehiculo_id" name="marca_vehiculo_id" required>
                                <option value="" disabled selected>Seleccione una marca</option>
                                @foreach($marcas as $marca)
                                    <option value="{{ $marca->id }}">
                                        {{ old('marca_vehiculo_id', $vehiculo->marca_vehiculo_id ?? '') == $marca->id ? 'selected' : '' }}>
                                        {{ $marca->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="Modelo">Modelo</label>
                            <input type="text" class="form-control" id="modelo" name="modelo" required>
                            <label for="Año">Año</label>
                            <input type="number" class="form-control" id="año" name="año" required>
                            <label for="VTV">VTV</label>
                            <input type="date" class="form-control" id="vtv" name="vtv" required>
                            <label for="Foto">Foto</label>
                            <input type="file" class="img-responsive" id="foto" name="foto">
                        </div>
                        <button type="submit" class="btn btn-primary">Crear vehiculo</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection