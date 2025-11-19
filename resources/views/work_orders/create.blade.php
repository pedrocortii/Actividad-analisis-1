@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Crear Nueva Orden de Trabajo</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('work-orders.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Tipo de Servicio</label>
                            <select class="form-control" id="descripcion" name="descripcion" required>
                                <option value="">Seleccione un tipo de servicio</option>
                                @foreach($tareas as $tarea)
                                    <option value="{{ $tarea->nombre }}">{{ $tarea->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="direccion_de_servicio" class="form-label">Dirección del Servicio</label>
                            <input type="text" class="form-control" id="direccion_de_servicio" name="direccion_de_servicio" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar Solicitud</button>
                        <a href="{{ route('work-orders.index') }}" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
