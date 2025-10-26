@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-primary">Gerenciamento de Produtos</h1>
        <a href="{{ route('produtos.create') }}" class="btn btn-success">
            <i class="fas fa-plus-circle me-2"></i> Criar Novo Produto
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($produtos->isEmpty())
        <div class="alert alert-info text-center" role="alert">
            Nenhum produto cadastrado. Comece criando um!
        </div>
    @else
        <div class="table-responsive bg-white shadow-sm rounded">
            <table class="table table-hover table-striped mb-0">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produtos as $produto)
                        <tr>
                            <td>{{ $produto->id }}</td>
                            <td>{{ $produto->name }}</td>
                            <td>{{ Str::limit($produto->description, 50) }}</td>
                            <td class="d-flex gap-2">
                                <a href="{{ route('produtos.edit', $produto->id) }}" class="btn btn-warning btn-sm">
                                    Editar
                                </a>
                                <form action="{{ route('produtos.destroy', $produto->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este produto?');" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
