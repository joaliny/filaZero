@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Filas do Hospital</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Hospital</th>
                <th>Atualizado em</th>
            </tr>
        </thead>
        <tbody>
            @foreach($filas as $fila)
                <tr>
                    <td>{{ $fila->id }}</td>
                    <td>{{ $fila->hospital_id }}</td>
                    <td>{{ $fila->updated_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
