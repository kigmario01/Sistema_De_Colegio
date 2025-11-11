<table>
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Estudiante</th>
            <th>Materia</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($records as $record)
        <tr>
            <td>{{ $record->date }}</td>
            <td>{{ $record->student->first_name }} {{ $record->student->last_name }}</td>
            <td>{{ $record->subject->name }}</td>
            <td>{{ ucfirst($record->status) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
