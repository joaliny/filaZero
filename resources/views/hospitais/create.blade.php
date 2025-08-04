@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Cadastrar Hospital </h1>

    <form action="{{ route('hospitais.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Endereço</label>
            <input type="text" name="endereco" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Telefone</label>
            <input type="text" name="telefone" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Horário</label>
            <input type="text" name="horario" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Fonte API (opcional)</label>
            <input type="text" name="fonte_api" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Salvar</button>
    </form>
</div>
@endsection
