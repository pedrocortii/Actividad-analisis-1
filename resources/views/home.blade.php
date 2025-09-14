@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center mb-4">
        <div class="col-lg-8 text-center">
            <h2 class="fw-bold text-info mb-1">Bienvenido{{ Auth::user() ? ', ' . Auth::user()->name : '' }}!</h2>
            <p class="text-muted">Panel principal del sistema</p>
        </div>
    </div>

    <div class="row text-center mb-4">
        <div class="col-md-4 col-12 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <i class="fa-solid fa-car fa-2x text-info mb-2"></i>
                    <h5 class="card-title mb-2 text-info">Vehículos</h5>
                    <p class="display-6 fw-bold text-info">{{ \App\Models\Vehiculo::count() }}</p>
                    <a href="{{ route('vehiculos.index') }}" class="btn btn-outline-info btn-sm">Ver vehículos</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-12 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <i class="fa-solid fa-users fa-2x text-success mb-2"></i>
                    <h5 class="card-title mb-2 text-success">Empleados</h5>
                    <p class="display-6 fw-bold text-success">{{ \App\Models\Employee::count() }}</p>
                    <a href="{{ route('employees.index') }}" class="btn btn-outline-success btn-sm">Ver empleados</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-12 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <i class="fa-solid fa-people-group fa-2x text-primary mb-2"></i>
                    <h5 class="card-title mb-2 text-primary">Grupos de Trabajo</h5>
                    <p class="display-6 fw-bold text-primary">{{ \App\Models\WorkGroup::count() }}</p>
                    <a href="{{ route('work-groups.index') }}" class="btn btn-outline-primary btn-sm">Ver grupos</a>
                </div>
            </div>
        </div>
    </div>

    <hr class="my-4">

    <div class="row justify-content-center mt-4">
        <div class="col-lg-8 text-center">
            <h5 class="mb-3">¿Qué deseas hacer?</h5>
            <a href="{{ route('work-groups.create') }}" class="btn btn-info mx-2">Crear Grupo de Trabajo</a>
            <a href="{{ route('vehiculos.create') }}" class="btn btn-success mx-2">Agregar Vehículo</a>
            <a href="{{ route('employees.create') }}" class="btn btn-primary mx-2">Agregar Empleado</a>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    body {
        background: #f4f8fb;
    }
    .card {
        animation: fadeIn 0.8s;
        border-radius: 16px;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px);}
        to { opacity: 1; transform: translateY(0);}
    }
</style>
@endpush