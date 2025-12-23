<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Produto;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProdutoTest extends TestCase
{
    use RefreshDatabase;

    public function test_retornar_produtos_paginados()
    {
        $per_page = 5;
        Produto::factory()->count(15)->create();

        $response = $this->getJson('/api/produtos?per_page='.$per_page);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data',
                'current_page',
                'last_page',
                'total'
            ]);

        $this->assertCount($per_page, $response->json('data'));
    }

    public function test_criar_um_produto_com_sucesso()
    {
        $user = \App\Models\User::factory()->create();

        $token = $user->createToken('teste-token')->plainTextToken;

        $dados = [
            "nome" => "Produto Teste",
            "descricao" => "Descrição do Produto Teste",
            "preco" => 99.90,
            "estoque" => 20
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->postJson('/api/produtos', $dados);

        $response->assertStatus(201)
            ->assertJsonFragment(["nome" => "Produto Teste"]);

        $this->assertDatabaseHas('produtos', $dados);
    }

    public function test_filtrar_produtos_por_nome()
    {
        \App\Models\Produto::factory()->create(['nome' => 'Produto 1']);
        \App\Models\Produto::factory()->create(['nome' => 'Produto 2']);
        \App\Models\Produto::factory()->create(['nome' => 'Produto Teste']);

        $response = $this->getJson('/api/produtos?nome=Produto Teste');

        $response->assertStatus(200);
        $response->assertJsonFragment(['nome' => 'Produto Teste']);
    }

    public function test_atualizar_um_produto()
    {
        $user = \App\Models\User::factory()->create();

        $token = $user->createToken('teste-token')->plainTextToken;

        $produto = \App\Models\Produto::factory()->create();

        $dados = [
            'nome' => 'Produto Atualizado',
            'descricao' => 'Descrição do Produto Atualizado',
            'preco' => 149.99,
            'estoque' => 20,
        ];

        $response = $this->putJson(
            '/api/produtos/' . $produto->id,
            $dados,
            ['Authorization' => 'Bearer ' . $token]
        );

        $response->assertStatus(200);

        $response->assertJson([
            'mensagem' => 'Produto Atualizado com Sucesso',
        ]);

        $this->assertDatabaseHas('produtos', $dados);
    }

    public function test_deletar_um_produto()
    {
        $user = \App\Models\User::factory()->create();

        $token = $user->createToken('teste-token')->plainTextToken;

        $produto = \App\Models\Produto::factory()->create();

        $response = $this->deleteJson(
            '/api/produtos/' . $produto->id,
            [],
            ['Authorization' => 'Bearer ' . $token]
        );

        $response->assertStatus(200);

        $response->assertJson([
            'mensagem' => 'Produto Deletado com Sucesso',
        ]);

        $this->assertDatabaseMissing('produtos', ['id' => $produto->id]);
    }
}
