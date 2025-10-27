<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ProdutosController extends Controller
{
    public function index(): View {
        $produtos = Produto::latest()->paginate(10);
        return view('produtos.index', compact('produtos'));
    }

    public function create(): View {
        return view('produtos.create');
    }

    public function store(Request $request): RedirectResponse {
        $request->validate([
            'nome' => 'required|min:5',
            'descricao' => 'nullable|min:10',
            'preco' => 'required|numeric',
            'estoque' => 'required|numeric',
        ]);

        Produto::create($request->only('nome','descricao','preco','estoque'));
        return redirect()->route('produtos.index')->with('success', 'Produto criado com sucesso!');
    }

    public function show(Produto $produto): View {
        return view('produtos.show', compact('produto'));
    }

    public function edit(Produto $produto): View {
        return view('produtos.edit', compact('produto'));
    }

    public function update(Request $request, Produto $produto): RedirectResponse {
        $request->validate([
            'nome' => 'required|min:5',
            'descricao' => 'nullable|min:10',
            'preco' => 'required|numeric',
            'estoque' => 'required|numeric',
        ]);

        $produto->update($request->only('nome','descricao','preco','estoque'));
        return redirect()->route('produtos.index')->with('success', 'Produto atualizado com sucesso!');
    }

    public function destroy(Produto $produto): RedirectResponse {
        $produto->delete();
        return redirect()->route('produtos.index')->with('success', 'Produto excluído com sucesso!');
    }
}
