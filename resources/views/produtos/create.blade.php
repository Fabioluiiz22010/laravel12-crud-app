@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-slate-100 p-4 sm:p-8 font-sans">
    <div class="max-w-3xl mx-auto mt-10">
        <!-- Card do Formulário de Criação -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            
            <!-- Header: Cor escura (Slate-800) para combinar com a Navbar -->
            <div class="bg-slate-800 p-6 sm:p-8">
                <h2 class="text-2xl font-bold text-blue-400">
                    Criação: <span class="text-white">Novo Produto</span>
                </h2>
            </div>
            
            <!-- Corpo do Formulário -->
            <div class="p-6 sm:p-8">
                
                <form action="{{ route('produtos.store') }}" method="POST">
                    @csrf 
                    
                    <!-- Grupo: Nome do Produto (Campo único, largura total) -->
                    <div class="mb-6">
                        <label for="nome" class="block text-sm font-medium text-gray-700 mb-2">Nome do Produto</label>
                        <input type="text" name="nome" id="nome" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-150 @error('nome') border-red-500 @enderror" 
                               value="{{ old('nome') }}" 
                               required>
                        
                        @error('nome')
                            <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Grupo: Descrição (Campo de texto grande) -->
                    <div class="mb-6">
                        <label for="descricao" class="block text-sm font-medium text-gray-700 mb-2">Descrição (Opcional)</label>
                        <textarea name="descricao" id="descricao" rows="5" 
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-150 @error('descricao') border-red-500 @enderror"
                                  >{{ old('descricao') }}</textarea>
                        @error('descricao')
                            <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Grupo: Preço -->
                    <div class="mb-6">
                        <label for="preco" class="block text-sm font-medium text-gray-700 mb-2">Preço (R$)</label>
                        <input type="number" step="0.01" min="0" name="preco" id="preco" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-150 @error('preco') border-red-500 @enderror" 
                               value="{{ old('preco') }}" 
                               required>
                        
                        @error('preco')
                            <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Grupo: Estoque -->
                    <div class="mb-8">
                        <label for="estoque" class="block text-sm font-medium text-gray-700 mb-2">Estoque</label>
                        <input type="number" min="0" name="estoque" id="estoque" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-150 @error('estoque') border-red-500 @enderror" 
                               value="{{ old('estoque') }}" 
                               required>
                        
                        @error('estoque')
                            <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Ações: Botões -->
                    <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-4">
                        
                        <!-- Botão de Salvar (Blue Primary Button) -->
                        <button type="submit" 
                                class="w-full sm:w-auto px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition duration-300 ease-in-out transform hover:scale-[1.02] focus:outline-none focus:ring-4 focus:ring-blue-500/50">
                            <!-- SVG de Salvar/Atualizar -->
                            <svg class="w-5 h-5 inline me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-4 0V4a2 2 0 00-2-2H9a2 2 0 00-2 2v3m4 0h.01M12 11v6m-3-3h6"></path></svg> 
                            Salvar Novo Produto
                        </button>
                        
                        <!-- Botão de Cancelar (Secondary/Link Button) -->
                        <a href="{{ route('produtos.index') }}" 
                           class="w-full sm:w-auto px-6 py-3 text-center bg-gray-100 text-gray-700 font-semibold rounded-lg shadow-md hover:bg-gray-200 transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-gray-300">
                            Voltar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
