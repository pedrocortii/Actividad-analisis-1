<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Grupos de Trabajo</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Reporte de Grupos de Trabajo</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Vehículo</th>
                <th>Empleados</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($workGroups as $workGroup)
                <tr>
                    <td>{{ $workGroup->id }}</td>
                    <td>{{ $workGroup->name }}</td>
                    <td>{{ $workGroup->vehiculo->patente ?? 'N/A' }}</td>
                    <td>
                        @foreach($workGroup->employees as $employee)
                            {{ $employee->nombre }} {{ $employee->apellido }}@if(!$loop->last), @endif
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
