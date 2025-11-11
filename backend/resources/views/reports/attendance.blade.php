<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #333; padding: 4px; }
        th { background: #f4f4f5; }
    </style>
</head>
<body>
    <h1>Reporte de asistencia - {{ $classroom->name }}</h1>
    <p>Periodo: {{ optional($classroom->academicPeriod)->name }}</p>
    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Estudiante</th>
                <th>Materia</th>
                <th>Estado</th>
                <th>Observaciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($records as $record)
            <tr>
                <td>{{ $record->date }}</td>
                <td>{{ $record->student->first_name }} {{ $record->student->last_name }}</td>
                <td>{{ $record->subject->name }}</td>
                <td>{{ ucfirst($record->status) }}</td>
                <td>{{ $record->notes }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>
