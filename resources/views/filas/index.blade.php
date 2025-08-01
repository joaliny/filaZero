@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Painel de Filas de Pronto-Socorro</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Hospital</th>
                <th>Fila Atual</th>
                <th>Última Atualização</th>
            </tr>
        </thead>
        <tbody>
            @foreach($hospitais as $hospital)
                <tr>
                    <td>{{ $hospital->nome }}</td>
                    <td>{{ $hospital->fila->quantidade ?? 'N/D' }}</td>
                    <td>{{ $hospital->fila->atualizado_em ?? 'N/D' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
