<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Vehículos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            color: #333;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .filters {
            margin-bottom: 20px;
        }
        .filters p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <h1>Reporte de Vehículos</h1>

    <div class="filters">
        @if ($desde || $hasta || $marca)
            <p><strong>Filtros aplicados:</strong></p>
            @if ($desde)
                <p>Desde: {{ \Carbon\Carbon::parse($desde)->format('d/m/Y') }}</p>
            @endif
            @if ($hasta)
                <p>Hasta: {{ \Carbon\Carbon::parse($hasta)->format('d/m/Y') }}</p>
            @endif
            @if ($marca)
                <p>Marca: {{ $marca->nombre }}</p>
            @endif
        @else
            <p>No se aplicaron filtros.</p>
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Patente</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Año</th>
                <th>Estado</th>
                <th>VTV</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vehiculos as $vehiculo)
                <tr>
                    <td>{{ $vehiculo->id }}</td>
                    <td>{{ $vehiculo->patente }}</td>
                    <td>{{ $vehiculo->marca->nombre ?? 'N/A' }}</td>
                    <td>{{ $vehiculo->modelo }}</td>
                    <td>{{ $vehiculo->año }}</td>
                    <td>{{ ucfirst(str_replace('_', ' ', $vehiculo->estado)) }}</td>
                    <td>{{ $vehiculo->vtv ? 'Sí' : 'No' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
