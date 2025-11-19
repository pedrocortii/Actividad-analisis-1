@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Editar Orden de Trabajo #{{ $workOrder->codigo }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('work-orders.update', $workOrder->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción del Problema</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required>{{ old('descripcion', $workOrder->descripcion) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="direccion_de_servicio" class="form-label">Dirección del Servicio</label>
                            <input type="text" class="form-control" id="direccion_de_servicio" name="direccion_de_servicio" value="{{ old('direccion_de_servicio', $workOrder->direccion_de_servicio) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="prioridad" class="form-label">Prioridad</label>
                            <select class="form-control" id="prioridad" name="prioridad" required>
                                <option value="Baja" {{ old('prioridad', $workOrder->prioridad) == 'Baja' ? 'selected' : '' }}>Baja</option>
                                <option value="Media" {{ old('prioridad', $workOrder->prioridad) == 'Media' ? 'selected' : '' }}>Media</option>
                                <option value="Alta" {{ old('prioridad', $workOrder->prioridad) == 'Alta' ? 'selected' : '' }}>Alta</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="fecha_programada" class="form-label">Fecha Programada</label>
                            <input type="date" class="form-control" id="fecha_programada" name="fecha_programada" value="{{ old('fecha_programada', $workOrder->fecha_programada ? $workOrder->fecha_programada->format('Y-m-d') : '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="work_group_id" class="form-label">Asignar Grupo de Trabajo</label>
                            <select class="form-control" id="work_group_id" name="work_group_id">
                                <option value="">Sin Asignar</option>
                                @foreach($workGroups as $group)
                                    <option value="{{ $group->id }}" {{ old('work_group_id', $workOrder->work_group_id) == $group->id ? 'selected' : '' }}>
                                        {{ $group->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Actualizar Orden</button>
                        <a href="{{ route('work-orders.index') }}" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection