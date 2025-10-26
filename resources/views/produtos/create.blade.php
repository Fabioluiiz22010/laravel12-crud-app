@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white text-center">
            <h2 class="mb-0">Criar Novo Produto</h2>
        </div>
        <div class="card-body p-4">
            <!-- O action aponta para a rota de armazenamento 'produtos.store' -->
            <form action="{{ route('produtos.store') }}" method="POST">
                @csrf 
                
                <div class="mb-3">
                    <label for="nome" class="form-label fw-bold">Nome do Produto</label>
                    <!-- O campo de input usa 'nome' (em Português) para o Controller -->
                    <input type="text" name="nome" id="nome" class="form-control @error('nome') is-invalid @enderror" value="{{ old('nome') }}" required>
                    @error('nome')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="descricao" class="form-label fw-bold">Descrição</label>
                    <!-- O campo de textarea usa 'descricao' (em Português) para o Controller -->
                    <textarea name="descricao" id="descricao" rows="5" class="form-control @error('descricao') is-invalid @enderror" required>{{ old('descricao') }}</textarea>
                    @error('descricao')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success btn-lg">
                        <i class="fas fa-save me-2"></i> Salvar Produto
                    </button>
                    <a href="{{ route('produtos.index') }}" class="btn btn-secondary btn-lg">
                        Voltar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
