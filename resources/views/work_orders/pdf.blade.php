<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Órdenes de Trabajo</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Reporte de Órdenes de Trabajo</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Código</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Prioridad</th>
                <th>Fecha Solicitud</th>
                <th>Cliente</th>
                <th>Grupo de Trabajo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($workOrders as $workOrder)
                <tr>
                    <td>{{ $workOrder->id }}</td>
                    <td>{{ $workOrder->codigo }}</td>
                    <td>{{ $workOrder->descripcion }}</td>
                    <td>{{ $workOrder->estado }}</td>
                    <td>{{ $workOrder->prioridad }}</td>
                    <td>{{ $workOrder->fecha_solicitud }}</td>
                    <td>{{ $workOrder->user->name ?? 'N/A' }}</td>
                    <td>{{ $workOrder->workGroup->name ?? 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
