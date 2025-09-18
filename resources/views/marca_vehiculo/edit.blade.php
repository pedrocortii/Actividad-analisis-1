@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Editar marca de vehiculo</div>
                <div class="card-body">
                    <form action="{{ route('marcaVehiculos.update', $marcaVehiculo->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre de la marca</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $marcaVehiculo->nombre }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                        <a href="{{ route('marcaVehiculos.index') }}" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection