<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class ProdutoController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        new Middleware('auth:sanctum', except: ['index', 'show']);
    }

    public function index(Request $request)
    {
        $query = Produto::query();

        if ($request->filled('nome'))
            $query->where('nome', 'like', '%' . trim($request->nome) . '%');

        $produtos = $query->paginate(3);

        if ($produtos->isEmpty())
            return response()->json(["message" => "Nenhum produto encontrado"], 404);


        return response()->json($produtos, 200);
    }

    public function show(Request $request)
    {
        $produto = Produto::find($request->id);

        if (!$produto)
            return response()->json(["erro" => "Produto não encontrado"], 404);


        return response()->json($produto, 200);
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            "nome" => "required|string|max:255",
            "descricao" => "nullable|string",
            "preco" => "required|numeric|min:0",
            "estoque" => "required|integer|min:0"
        ]);

        $user = $request->user();

        if (!$user)
            return response()->json(['message' => 'Usuário não autenticado'], 401);


        $produto = Produto::create($dados);

        return response()->json(["mensagem" => "Produto Criado com Sucesso", "produto" => $produto], 201);
    }

    public function update(Request $request)
    {
        $user = $request->user();

        if (!$user)
            return response()->json(['message' => 'Usuário não autenticado'], 401);


        $produto = Produto::find($request->id);

        if (!$produto)
            return response()->json(["erro" => "Produto não encontrado"], 404);


        $dados = $request->validate([
            "nome" => "required|string|max:255",
            "descricao" => "nullable|string",
            "preco" => "required|numeric|min:0",
            "estoque" => "required|integer|min:0"
        ]);

        $produto->update($dados);

        return response()->json([
            "mensagem" => "Produto Atualizado com Sucesso",
            "produto" => $produto
        ], 200);
    }

    public function destroy(Request $request)
    {
        $user = $request->user();

        if (!$user)
            return response()->json(['message' => 'Usuário não autenticado'], 401);

        $produto = Produto::find($request->id);

        if (!$produto)
            return response()->json(["erro" => "Produto não encontrado"], 404);

        $produto->delete();

        return response()->json(["mensagem" => "Produto Deletado com Sucesso"], 200);
    }
}
