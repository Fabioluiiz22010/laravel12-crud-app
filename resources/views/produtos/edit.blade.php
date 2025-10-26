@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-warning text-white text-center">
            <h2 class="mb-0">Editar Produto: {{ $produto->name }}</h2>
        </div>
        <div class="card-body p-4">
            <!-- O action aponta para o método de update (PUT/PATCH) da rota 'produtos.update' -->
            <form action="{{ route('produtos.update', $produto->id) }}" method="POST">
                @csrf 
                @method('PUT') <!-- Essencial para o método HTTP de atualização -->

                <div class="mb-3">
                    <label for="nome" class="form-label fw-bold">Nome do Produto</label>
                    <!-- Preenche o campo com o valor atual do produto ($produto->name) -->
                    <input type="text" name="nome" id="nome" class="form-control @error('nome') is-invalid @enderror" value="{{ old('nome', $produto->name) }}" required>
                    @error('nome')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="descricao" class="form-label fw-bold">Descrição</label>
                    <!-- Preenche a textarea com o valor atual do produto ($produto->description) -->
                    <textarea name="descricao" id="descricao" rows="5" class="form-control @error('descricao') is-invalid @enderror" required>{{ old('descricao', $produto->description) }}</textarea>
                    @error('descricao')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-warning btn-lg">
                        <i class="fas fa-edit me-2"></i> Atualizar Produto
                    </button>
                    <a href="{{ route('produtos.index') }}" class="btn btn-secondary btn-lg">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
