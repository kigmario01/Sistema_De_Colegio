@extends('layouts.app')

@section('title', 'Oferta educativa')

@section('content')
<h1>Oferta educativa</h1>
<table>
    <thead>
        <tr>
            <th>Materia</th>
            <th>Código</th>
            <th>Grado</th>
            <th>Créditos</th>
            <th>Nota mínima</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($subjects as $subject)
        <tr>
            <td>{{ $subject->name }}</td>
            <td>{{ $subject->code }}</td>
            <td>{{ $subject->grade_level }}</td>
            <td>{{ $subject->credits }}</td>
            <td>{{ $subject->pass_score }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
