@extends('layouts.app')

@section('title', 'Horarios')

@section('content')
<h1>Horarios de clases</h1>
@foreach ($classrooms as $classroom)
    <section>
        <h2>{{ $classroom->name }} - Grado {{ $classroom->grade_level }}</h2>
        <table>
            <thead>
                <tr>
                    <th>Día</th>
                    <th>Materia</th>
                    <th>Docente</th>
                    <th>Inicio</th>
                    <th>Fin</th>
                    <th>Aula</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($classroom->schedules as $schedule)
                <tr>
                    <td>{{ ucfirst($schedule->day_of_week) }}</td>
                    <td>{{ $schedule->subject->name }}</td>
                    <td>{{ $schedule->teacher->first_name }} {{ $schedule->teacher->last_name }}</td>
                    <td>{{ $schedule->starts_at }}</td>
                    <td>{{ $schedule->ends_at }}</td>
                    <td>{{ $schedule->room }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>
@endforeach
@endsection
