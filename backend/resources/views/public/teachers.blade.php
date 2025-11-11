@extends('layouts.app')

@section('title', 'Docentes')

@section('content')
<h1>Docentes</h1>
@foreach ($teachers as $teacher)
    <article>
        <h2>{{ $teacher->first_name }} {{ $teacher->last_name }}</h2>
        <p><strong>Especialidad:</strong> {{ $teacher->specialty }}</p>
        <p><strong>Materias:</strong> {{ $teacher->subjects->pluck('name')->implode(', ') }}</p>
    </article>
@endforeach
@endsection
