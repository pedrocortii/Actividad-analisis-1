<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Empleados</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Reporte de Empleados</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>DNI</th>
                <th>Rol</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
                <tr>
                    <td>{{ $employee->id }}</td>
                    <td>{{ $employee->nombre }}</td>
                    <td>{{ $employee->apellido }}</td>
                    <td>{{ $employee->dni }}</td>
                    <td>{{ $employee->rol }}</td>
                    <td>{{ $employee->estado }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
