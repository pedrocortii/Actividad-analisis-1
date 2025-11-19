@extends('layouts.admin') {{-- O layouts.admin si el cliente usa la plantilla de admin --}}

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <h3 class="fw-bold mb-4">Bienvenido, {{ $user->name }}</h3>

            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Tus Órdenes de Servicio</h5>
                    <a href="{{ route('work-orders.create') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-plus me-1"></i> Solicitar Nueva Orden
                    </a>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($workOrders->isEmpty())
                        <p class="text-muted">No tienes órdenes de trabajo registradas.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover table-striped align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Código</th>
                                        <th>Descripción</th>
                                        <th>Dirección</th>
                                        <th>Estado</th>
                                        <th>Fecha Solicitud</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($workOrders as $order)
                                    <tr>
                                        <td>{{ $order->codigo }}</td>
                                        <td>{{ $order->descripcion }}</td>
                                        <td>{{ $order->direccion_de_servicio }}</td>
                                        <td>
                                            <span class="badge 
                                                @if($order->estado == 'Pendiente de Asignacion') bg-warning text-dark
                                                @elseif($order->estado == 'Asignado') bg-info
                                                @elseif($order->estado == 'Completado') bg-success
                                                @elseif($order->estado == 'Rechazado') bg-danger
                                                @else bg-secondary @endif">
                                                {{ $order->estado }}
                                            </span>
                                        </td>
                                        <td>{{ $order->fecha_solicitud->format('d/m/Y') }}</td>
                                        <td>
                                            <a href="{{ route('work-orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary">Ver Detalles</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection