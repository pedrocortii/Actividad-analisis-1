@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{__('Crear Nuevo Movil') }}</div>

                <div class="card-body">
                    <form action="{{ route('movil.store') }}" method="POST">
                        @csrf   
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                            <label for="codigo">Codigo</label>
                            <input type="number" class="form-control" id="codigo" name="codigo" required>
                            <label for="zona_asignada">Zona asignada</label>
                            <input type="text" class="form-control" id="zona_asignada" name="zona_asignada" required>
                            <label for="estado">Estado</label>
                            <select class="form-control" id="estado" name="estado">
                                <option value="activo">Activo</option>
                                <option value="inactivo">Inactivo</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Crear vehiculo</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection