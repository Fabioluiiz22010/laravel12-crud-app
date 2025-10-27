<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProdutosApiController extends Controller
{
    // Listar todos os produtos
    public function index(): JsonResponse
    {
        return response()->json(Produto::all(), 200);
    }

    // Mostrar um produto específico
    public function show(Produto $produto): JsonResponse
    {
        return response()->json($produto, 200);
    }

    // Criar um novo produto
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'nome' => 'required|min:5',
            'descricao' => 'nullable|min:10',
            'preco' => 'required|numeric',
            'estoque' => 'required|numeric',
        ]);

        $produto = Produto::create($request->only(['nome','descricao','preco','estoque']));

        return response()->json($produto, 201);
    }

    // Atualizar um produto
    public function update(Request $request, Produto $produto): JsonResponse
    {
        $request->validate([
            'nome' => 'required|min:5',
            'descricao' => 'nullable|min:10',
            'preco' => 'required|numeric',
            'estoque' => 'required|numeric',
        ]);

        $produto->update($request->only(['nome','descricao','preco','estoque']));

        return response()->json($produto, 200);
    }

    // Excluir um produto
    public function destroy(Produto $produto): JsonResponse
    {
        $produto->delete();
        return response()->json(null, 204);
    }
}
