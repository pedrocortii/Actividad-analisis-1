@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Editar datos del movil</div>
                <div class="card-body">
                    <form action="{{ route('movil.update', $movil->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre del movil</label>
                            <input type="text" name="nombre" id="nombre" class="form-control " value="{{ old('nombre', $movil->nombre) }}">
                            <label for="codigo" class="form-label">Codigo del Movil</label>
                            <input type="number" name="codigo" id="codigo" class="form-control" value="{{ old('codigo', $movil->codigo) }}">
                            <label for="zona_asignada" class="form-label"></label>
                            <input type="text" name="zona_asignada" id="zona_asignada" class="form-control" value="{{ old('zona_asignada', $movil->zona_asignada) }}">
                            <label for="estado" class="form-label">Estado del movil</label>
                            <select class="form-control" id="estado" name="estado">
                                <option value="activo">Activo</option>
                                <option value="inactivo">Inactivo</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                        <a href="{{ route('movil.index') }}" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection