@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-100 p-4 sm:p-8 font-sans">
    <div class="max-w-7xl mx-auto mt-10">

        <!-- Header e Botão de Ação -->
        <div class="flex flex-col sm:flex-row justify-between items-center mb-8 gap-4">
            <h1 class="text-3xl font-extrabold text-slate-800">Gerenciamento de Produtos</h1>
            
            <!-- Botão Criar Novo Produto (Blue Primary Button) -->
            <a href="{{ route('produtos.create') }}" 
               class="w-full sm:w-auto px-6 py-3 bg-blue-600 text-white font-semibold rounded-xl shadow-lg hover:bg-blue-700 transition duration-300 ease-in-out transform hover:scale-[1.02] focus:outline-none focus:ring-4 focus:ring-blue-500/50 flex items-center justify-center">
                <!-- Ícone de adição (simulado com SVG) -->
                <svg class="w-5 h-5 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Criar Novo Produto
            </a>
        </div>

        <!-- Mensagem de Sucesso (Estilizada com Tailwind) -->
        @if (session('success'))
            <div class="bg-emerald-100 border-l-4 border-emerald-500 text-emerald-800 p-4 rounded-lg mb-6" role="alert">
                <div class="flex items-center">
                    <svg class="w-5 h-5 me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    <p class="font-bold">Sucesso!</p>
                    <p class="ms-2">{{ session('success') }}</p>
                </div>
            </div>
        @endif
        
        <!-- Bloco Principal de Listagem/Mensagem Vazia -->
        @if ($produtos->isEmpty())
            <!-- Mensagem de Lista Vazia -->
            <div class="p-8 text-center bg-white rounded-xl shadow-lg border border-gray-200 text-gray-500">
                <p class="text-xl font-medium">Nenhum produto cadastrado.</p>
                <p class="mt-2">Use o botão "Criar Novo Produto" acima para começar!</p>
            </div>
        @else
            <!-- Tabela de Produtos -->
            <div class="overflow-x-auto bg-white rounded-xl shadow-xl">
                <table class="min-w-full divide-y divide-gray-200">
                    
                    <!-- Cabeçalho da Tabela (Cor Slate Escura para contraste) -->
                    <thead class="bg-slate-800">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">ID</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">Título</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider hidden md:table-cell">Descrição</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">Preço</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">Estoque</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-semibold text-slate-300 uppercase tracking-wider">Ações</th>
                        </tr>
                    </thead>
                    
                    <!-- Corpo da Tabela -->
                    <tbody class="bg-white divide-y divide-gray-100">
                        @foreach ($produtos as $produto)
                            <tr class="hover:bg-blue-50 transition duration-150">
                                
                                <!-- ID -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $produto->id }}</td>
                                
                                <!-- Nome -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $produto->nome }}</td>
                                
                                <!-- Descrição (Oculta em mobile) -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 hidden md:table-cell">
                                    {{ Str::limit($produto->descricao, 50) }}
                                </td>
                                
                                <!-- Preço -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-semibold">
                                    R$ {{ number_format($produto->preco, 2, ',', '.') }}
                                </td>
                                
                                <!-- Estoque (Destaque para baixo estoque) -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        @if ($produto->estoque < 10) 
                                            bg-red-100 text-red-800 border border-red-500
                                        @else 
                                            bg-green-100 text-green-800
                                        @endif">
                                        {{ $produto->estoque }}
                                    </span>
                                </td>
                                
                                <!-- Ações -->
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <div class="flex justify-center space-x-3">
                                        
                                        <!-- Botão Editar (Blue Link) -->
                                        <a href="{{ route('produtos.edit', $produto) }}" 
                                           class="text-blue-600 hover:text-blue-900 font-medium transition duration-150 ease-in-out">
                                            Editar
                                        </a>

                                        <!-- Formulário de Exclusão (Red Button) -->
                                        <form action="{{ route('produtos.destroy', ['produto' => $produto->id]) }}" method="POST" 
                                              onsubmit="return confirm('Tem certeza que deseja excluir este produto?');" 
                                              class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="text-red-600 hover:text-red-900 font-medium transition duration-150 ease-in-out">
                                                Excluir
                                            </button>
                                        </form>
                                        
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif 
        <!-- Fim do bloco Principal de Listagem/Mensagem Vazia -->

    </div>
</div>
@endsection
