@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                <div class="card-header bg-gradient bg-info text-white d-flex justify-content-between align-items-center border-bottom" style="border-radius: 12px 12px 0 0;">
                    <div>
                        <h4 class="mb-0 fw-semibold text-white">Grupos de Trabajo</h4>
                        <small class="text-light">Listado de grupos y sus integrantes</small>
                    </div>
                    <a href="{{ route('work-groups.create') }}" class="btn btn-success btn-sm" title="Agregar Grupo de Trabajo">
                        <i class="fa-solid fa-plus"></i> Nuevo Grupo
                    </a>
                </div>
                <div class="card-body bg-light">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table align-middle table-hover" style="background-color: #f8fafc;">
                            <thead style="background-color: #e3f2fd;">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Vehículo</th>
                                    <th>Empleados</th>
                                    <th class="text-end">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($workGroups as $workGroup)
                            <tr>
                                <td>{{ $workGroup->id }}</td>
                                <td class="fw-medium text-primary">{{ $workGroup->name }}</td>
                                <td>
                                    @if ($workGroup->vehiculo)
                                        <span class="fw-bold text-info">{{ $workGroup->vehiculo->patente }}</span>
                                        <br>
                                        <span class="text-muted small">{{ $workGroup->vehiculo->marca }} {{ $workGroup->vehiculo->modelo }}</span>
                                    @else
                                        <span class="text-danger">Sin vehículo</span>
                                    @endif
                                </td>
                                <td>
    <ul class="mb-0 ps-3">
        @foreach ($workGroup->employees as $employee)
            <li class="mb-3">
                <span class="fw-semibold">DNI:</span> {{ $employee->dni }}<br>
                <span class="fw-normal">{{ $employee->nombre }} {{ $employee->apellido }}</span><br>
                <span class="fw-semibold">Estado:</span>
                <span class="badge 
                    @if($employee->estado === 'activo') bg-success 
                    @elseif($employee->estado === 'inactivo') bg-danger 
                    @else bg-secondary 
                    @endif
                    text-white ms-1">{{ $employee->estado }}</span>
            </li>
            @if (!$loop->last)
                <hr class="my-1" style="border-top: 1px dashed #b0bec5;">
            @endif
        @endforeach
    </ul>
</td>
                                <td class="text-end">
                                    <div class="d-inline-flex gap-1">
                                        <a href="{{ route('work-groups.show', $workGroup->id) }}" class="btn btn-outline-info btn-sm" title="Ver detalles">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href="{{ route('work-groups.edit', $workGroup->id) }}" class="btn btn-outline-warning btn-sm" title="Editar Grupo">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <form action="{{ route('work-groups.destroy', $workGroup->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm" title="Eliminar Grupo" onclick="return confirm('¿Estás seguro de eliminar este Grupo de Trabajo?')">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center mt-3">
                            {{ $workGroups->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .table-hover tbody tr:hover {
        background-color: #e3f2fd;
    }
    .badge {
        font-size: 0.85em;
        padding: 0.35em 0.6em;
    }
</style>
@endpush