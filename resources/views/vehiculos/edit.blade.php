@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Editar Vehiculo</div>
                <div class="card-body">
                    <form action="{{ route('vehiculos.update', $vehiculo->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
    <label for="patente" class="form-label">Patente del vehiculo</label>
    <input type="text" name="patente" id="patente" class="form-control" value="{{ old('patente', $vehiculo->patente) }}">

    <label for="marca" class="form-label">Marca del vehiculo</label>
    <input type="text" name="marca" id="marca" class="form-control" value="{{ old('marca', $vehiculo->marca) }}">

    <label for="modelo" class="form-label">Modelo del vehiculo</label>
    <input type="text" name="modelo" id="modelo" class="form-control" value="{{ old('modelo', $vehiculo->modelo) }}">

    <label for="año" class="form-label">Año del vehiculo</label>
    <input type="number" name="año" id="año" class="form-control" value="{{ old('año', $vehiculo->año) }}">

    <label for="foto" class="form-label">Foto del vehiculo</label>
    <input type="file" name="foto" id="foto" class="form-control" value="{{ old('foto', $vehiculo->foto) }}">

    <label for="vtv" class="form-label">VTV del vehiculo</label>
    <input type="date" name="vtv" id="vtv" class="form-control" value="{{ old('vtv', $vehiculo->vtv) }}">
</div>

                        <button type="submit" class="btn btn-primary">Actualizar</button>
                        <a href="{{ route('vehiculos.index') }}" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection