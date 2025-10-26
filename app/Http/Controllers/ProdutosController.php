<?php

namespace App\Http\Controllers;

//import model produto
use App\Models\Produto; 

//import return type View
use Illuminate\View\View;

//import return type redirectResponse
use Illuminate\Http\Request;

//import Http Request
use Illuminate\Http\RedirectResponse;

//import Facades Storage
use Illuminate\Support\Facades\Storage;

class ProdutosController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index() : View
    {
        //get all produtos
        $produtos = produto::latest()->paginate(10);

        //render view with produtos
        return view('produtos.index', compact('produtos'));
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('produtos.create');
    }

    /**
     * store
     *
     * @param  \Illuminate\Http\Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        //validar form
        $request->validate([
            'titulo'         => 'required|min:5',
            'descricao'   => 'required|min:10',
            'preco'         => 'required|numeric',
            'estoque'         => 'required|numeric'
        ]);

        produto::create([

            'titulo'         => $request->titulo,
            'descricao'   => $request->descricao,
            'preco'         => $request->preco,
            'estoque'         => $request->estoque
        ]);

        //redirect to index
        return redirect()->route('produtos.index')->with(['success' => 'conteúdo criado com sucesso!']);
    }
    
    /**
     * show
     *
     * @param  mixed $id
     * @return View
     */
    public function show(string $id): View
    {
        //get produto by ID
        $produto = Produto::findOrFail($id);

        //render view with produto
        return view('produtos.show', compact('produto'));
    }
    
    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        //get produto by ID
        $produto = Produto::findOrFail($id);

        //render view with produto
        return view('produtos.edit', compact('produto'));
    }
        
    /**
     * update
     *
     * @param  \Illuminate\Http\Request $request
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //validate form
        $request->validate([
            'titulo'         => 'required|min:5',
            'descricao'   => 'required|min:10',
            'preco'         => 'required|numeric',
            'estoque'         => 'required|numeric'
        ]);

        $produto = produto::findOrFail($id);
        $produto->update([
            'titulo'         => $request->titulo,
            'descricao'   => $request->descricao,
            'preco'         => $request->preco,
            'estoque'         => $request->estoque
        ]);
        return redirect()->route('produtos.index')->with(['success' => 'Upload realizado com sucesso!']);
    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        //get produto by ID
        $produto = produto::findOrFail($id);

        //delete produto
        $produto->delete();

        //redirect to index
        return redirect()->route('produtos.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}