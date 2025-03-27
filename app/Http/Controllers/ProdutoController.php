<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::paginate(3);

        return response()->json($produtos, 200);
    }

    public function show(Request $request)
    {
        $produto = Produto::find($request->id);

        return $produto;
    }

    public function store(Request $request)
    {
        Produto::create([
            "nome" => $request->nome,
            "descricao" => $request->descricao,
            "preco" => $request->preco,
            "estoque" => $request->estoque
        ]);

        return response(["Produto Criado com Sucesso"], 200);
    }

    public function update(Request $request)
    {
        $produto = Produto::find($request->id);

        $produto->nome = $request->nome;
        $produto->descricao = $request->descricao;
        $produto->preco = $request->preco;
        $produto->estoque = $request->estoque;

        $produto->save();

        return response(["Produto Atualizado com Sucesso"], 200);
    }

    public function destroy(Request $request)
    {
        $produto = Produto::find($request->id);

        $produto->delete();

        return response(["Produto Deletado com Sucesso"], 200);
    }

    public function filter(Request $request)
    {
        $query = Produto::query();

        if ($request->has('nome')) {
            $query->where('nome', 'like', '%' . $request->nome . '%');
        }

        $produtos = $query->get();

        return response()->json($produtos);
    }
}
