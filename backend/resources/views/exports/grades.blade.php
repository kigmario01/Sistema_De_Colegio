<table>
    <thead>
        <tr>
            <th>Estudiante</th>
            <th>Materia</th>
            <th>Nota final</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($grades as $grade)
        <tr>
            <td>{{ $grade->student->first_name }} {{ $grade->student->last_name }}</td>
            <td>{{ $grade->subject->name }}</td>
            <td>{{ $grade->final_grade }}</td>
            <td>{{ ucfirst($grade->status) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
