@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center mb-4">
        <div class="col-lg-8 text-center">
            <h2 class="fw-bold text-dark mb-1">
                Bienvenido{{ Auth::user() ? ', ' . Auth::user()->name : '' }}!
            </h2>
            <p class="text-muted">Panel principal del sistema</p>
        </div>
    </div>

    <div class="row text-center mb-4">
        <!-- Vehículos -->
        <div class="col-md-4 col-12 mb-3">
            <div class="card border-0 shadow-sm rounded-3 hover-card">
                <div class="card-body d-flex flex-column align-items-center">
                    <i class="fa-solid fa-car fa-3x text-info mb-3"></i>
                    <h5 class="card-title text-dark mb-2">Vehículos</h5>
                    <p class="display-5 fw-bold text-dark">{{ \App\Models\Vehiculo::count() }}</p>
                    <a href="{{ route('vehiculos.index') }}" class="btn btn-outline-dark btn-sm mt-2">Ver vehículos</a>
                </div>
            </div>
        </div>

        <!-- Empleados -->
        <div class="col-md-4 col-12 mb-3">
            <div class="card border-0 shadow-sm rounded-3 hover-card">
                <div class="card-body d-flex flex-column align-items-center">
                    <i class="fa-solid fa-users fa-3x text-success mb-3"></i>
                    <h5 class="card-title text-dark mb-2">Empleados</h5>
                    <p class="display-5 fw-bold text-dark">{{ \App\Models\Employee::count() }}</p>
                    <a href="{{ route('employees.index') }}" class="btn btn-outline-dark btn-sm mt-2">Ver empleados</a>
                </div>
            </div>
        </div>

        <!-- Grupos de Trabajo -->
        <div class="col-md-4 col-12 mb-3">
            <div class="card border-0 shadow-sm rounded-3 hover-card">
                <div class="card-body d-flex flex-column align-items-center">
                    <i class="fa-solid fa-people-group fa-3x text-primary mb-3"></i>
                    <h5 class="card-title text-dark mb-2">Grupos de Trabajo</h5>
                    <p class="display-5 fw-bold text-dark">{{ \App\Models\WorkGroup::count() }}</p>
                    <a href="{{ route('work-groups.index') }}" class="btn btn-outline-dark btn-sm mt-2">Ver grupos</a>
                </div>
            </div>
        </div>
    </div>

    <hr class="my-4">

    <div class="row justify-content-center mt-4">
        <div class="col-lg-8 text-center">
            <h5 class="mb-3 text-dark">¿Qué deseas hacer?</h5>
            <a href="{{ route('work-groups.create') }}" class="btn btn-outline-dark mx-2">Crear Grupo de Trabajo</a>
            <a href="{{ route('vehiculos.create') }}" class="btn btn-outline-dark mx-2">Agregar Vehículo</a>
            <a href="{{ route('employees.create') }}" class="btn btn-outline-dark mx-2">Agregar Empleado</a>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    body {
        background: #f4f6f9; /* gris claro AdminLTE */
    }
    .hover-card {
        border-radius: 12px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .hover-card:hover {
        transform: scale(1.03);
        box-shadow: 0 8px 20px rgba(0,0,0,0.12);
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px);}
        to { opacity: 1; transform: translateY(0);}
    }
</style>
@endpush
