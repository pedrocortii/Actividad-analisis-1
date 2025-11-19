@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Detalles de Orden de Trabajo #{{ $workOrder->codigo }}</h3>
                    <a href="{{ route('clientes.index') }}" class="btn btn-light btn-sm">{{ __('Volver a mis órdenes') }}</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <tbody>
                            <tr>
                                <th>Código:</th>
                                <td>{{ $workOrder->codigo }}</td>
                            </tr>
                            <tr>
                                <th>Descripción:</th>
                                <td>{{ $workOrder->descripcion }}</td>
                            </tr>
                            <tr>
                                <th>Dirección del Servicio:</th>
                                <td>{{ $workOrder->direccion_de_servicio }}</td>
                            </tr>
                            <tr>
                                <th>Fecha de Solicitud:</th>
                                <td>{{ $workOrder->fecha_solicitud->format('d/m/Y H:i') }}</td>
                            </tr>
                            <tr>
                                <th>Fecha Programada:</th>
                                <td>{{ $workOrder->fecha_programada ? $workOrder->fecha_programada->format('d/m/Y') : 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Fecha de Finalización:</th>
                                <td>{{ $workOrder->fecha_finalizacion ? $workOrder->fecha_finalizacion->format('d/m/Y H:i') : 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Estado:</th>
                                <td>
                                    <span class="badge 
                                        @if($workOrder->estado == 'Pendiente de Asignacion') bg-warning text-dark
                                        @elseif($workOrder->estado == 'Asignado') bg-info
                                        @elseif($order->estado == 'Completado') bg-success
                                        @elseif($order->estado == 'Rechazado') bg-danger
                                        @else bg-secondary @endif">
                                        {{ $workOrder->estado }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th>Prioridad:</th>
                                <td>{{ $workOrder->prioridad }}</td>
                            </tr>
                            <tr>
                                <th>Grupo de Trabajo Asignado:</th>
                                <td>{{ $workOrder->workGroup->name ?? 'Sin Asignar' }}</td>
                            </tr>
                            <tr>
                                <th>Observaciones:</th>
                                <td>{{ $workOrder->observaciones ?? 'N/A' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-end">
                    <a href="{{ route('clientes.index') }}" class="btn btn-secondary">{{ __('Volver') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
