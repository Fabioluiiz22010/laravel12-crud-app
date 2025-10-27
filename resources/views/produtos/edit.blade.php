<!-- Edição de Produto: Estilo Dark/Sleek, coeso com a barra de navegação -->

@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-slate-100 p-4 sm:p-8 font-sans">
    <div class="max-w-3xl mx-auto mt-10">
        <!-- Card for Form -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            
            <!-- Header: Cor escura (Slate-800) para combinar com a Navbar -->
            <div class="bg-slate-800 p-6 sm:p-8">
                <h2 class="text-2xl font-bold text-blue-400">
                    Editar Produto: <span class="text-white">{{ $produto->nome }}</span>
                </h2>
            </div>
            
            <!-- Form Body -->
            <div class="p-6 sm:p-8">
                
                <form action="{{ route('produtos.update', $produto->id) }}" method="POST">
                    
                    @csrf 
                    @method('PUT')

                    <!-- Grupo: Nome do Produto -->
                    <div class="mb-6">
                        <label for="nome" class="block text-sm font-medium text-gray-700 mb-2">Nome do Produto</label>
                        <input type="text" name="nome" id="nome" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-150 @error('nome') border-red-500 @enderror" 
                               value="{{ old('nome', $produto->nome) }}"
                               required>
                        
                        @error('nome')
                            <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Grupo: Descrição -->
                    <div class="mb-6">
                        <label for="descricao" class="block text-sm font-medium text-gray-700 mb-2">Descrição</label>
                        <textarea name="descricao" id="descricao" rows="5" 
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-150 @error('descricao') border-red-500 @enderror" 
                                  required>{{ old('descricao', $produto->descricao) }}</textarea>
                        
                        @error('descricao')
                            <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Grupo: Preço -->
                    <div class="mb-6">
                        <label for="preco" class="block text-sm font-medium text-gray-700 mb-2">Preço (R$)</label>
                        <input type="number" step="0.01" min="0" name="preco" id="preco" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-150 @error('preco') border-red-500 @enderror" 
                               value="{{ old('preco', $produto->preco) }}"
                               required>
                        
                        @error('preco')
                            <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Grupo: Estoque -->
                    <div class="mb-8">
                        <label for="estoque" class="block text-sm font-medium text-gray-700 mb-2">Estoque</label>
                        <input type="number" min="0" name="estoque" id="estoque" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-150 @error('estoque') border-red-500 @enderror" 
                               value="{{ old('estoque', $produto->estoque) }}"
                               required>
                        
                        @error('estoque')
                            <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Ações: Botões -->
                    <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-4">
                        
                        <!-- Botão de Atualizar (Blue Primary Button) -->
                        <button type="submit" 
                                class="w-full sm:w-auto px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition duration-300 ease-in-out transform hover:scale-[1.02] focus:outline-none focus:ring-4 focus:ring-blue-500/50">
                            <svg class="w-5 h-5 inline me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg> 
                            Atualizar Produto
                        </button>
                        
                        <!-- Botão de Cancelar (Secondary/Link Button) -->
                        <a href="{{ route('produtos.index') }}" 
                           class="w-full sm:w-auto px-6 py-3 text-center bg-gray-100 text-gray-700 font-semibold rounded-lg shadow-md hover:bg-gray-200 transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-gray-300">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
