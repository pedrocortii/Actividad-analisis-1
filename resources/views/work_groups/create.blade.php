@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-gradient bg-info text-white" style="border-radius: 12px 12px 0 0;">
                    <h4 class="mb-0 fw-semibold">Crear Grupo de Trabajo</h4>
                </div>
                <div class="card-body bg-light">
                    <form action="{{ route('work-groups.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre del Grupo</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="vehiculo_id" class="form-label">Vehículo</label>
                            <select class="form-select" id="vehiculo_id" name="vehiculo_id" required>
    <option value="">Seleccione un vehículo</option>
    @foreach ($vehiculos as $vehiculo)
        <option value="{{ $vehiculo->id }}">
            {{ $vehiculo->patente }} - {{ $vehiculo->marca }} {{ $vehiculo->modelo }}
        </option>
    @endforeach
</select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Empleados</label>
                            <div class="row">
                                @foreach ($employees as $employee)
                                    <div class="col-md-6 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="employee_ids[]" value="{{ $employee->id }}" id="employee{{ $employee->id }}">
                                            <label class="form-check-label" for="employee{{ $employee->id }}">
                                                {{ $employee->nombre }} {{ $employee->apellido }} <span class="text-muted">({{ $employee->dni }})</span>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Crear Grupo de Trabajo</button>
                        <a href="{{ route('work-groups.index') }}" class="btn btn-outline-secondary ms-2">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection