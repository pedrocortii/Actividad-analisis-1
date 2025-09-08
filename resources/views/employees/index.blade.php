@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Empleados</h2>
        <a href="{{ route('employees.create') }}" class="btn btn-success">
            <i class="fa-solid fa-plus"></i> Agregar empleado
        </a>
    </div>

    <div class="row g-3">
        @foreach($employees as $employee)
            <div class="col-md-4 col-lg-3">
                <div class="p-3 border rounded h-100 d-flex flex-column justify-content-between">
                    <div>
                        <h5>{{ $employee->nombre }} {{ $employee->apellido }}</h5>
                        <p class="mb-1"><strong>DNI:</strong> {{ $employee->dni }}</p>
                        <p class="mb-1"><strong>Email:</strong> {{ $employee->email }}</p>
                        <p class="mb-1"><strong>Tel:</strong> {{ $employee->telefono }}</p>
                        <p class="mb-1"><strong>Rol:</strong> {{ $employee->rol }}</p>
                        <p class="mb-1"><strong>Licencia:</strong> {{ $employee->licencia_conducir ? 'Sí' : 'No' }}</p>
                        <p class="mb-1"><strong>Estado:</strong> {{ $employee->estado }}</p>
                        <p class="mb-1"><strong>Fecha de contratación:</strong> {{ $employee->fecha_contratacion }}</p>
                        <p class="mb-1"><strong>Dirección:</strong> {{ $employee->direccion }}</p>
                    </div>
                    <div class="mt-2 d-flex gap-2">
                        <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning btn-sm flex-fill">
                            <i class="fa-solid fa-pen-to-square"></i> Editar
                        </a>
                        <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="flex-fill">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm w-100" onclick="return confirm('¿Estás seguro de eliminar este empleado?')">
                                <i class="fa-solid fa-trash"></i> Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
