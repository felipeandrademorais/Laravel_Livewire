<?php

namespace Tests\Feature\Livewire;

use App\Http\Livewire\Movimentacao;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;
use App\Models\Pessoas;
use App\Models\Conta;
use App\Models\Movimentacao as MovimentacaoModel;

class MovimentacaoTest extends TestCase
{

    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(Movimentacao::class);

        $component->assertStatus(200);
    }

    /** @test */
    public function salvar_movimentacao_test()
    {
        $pessoa = [
            'nome'       => 'Mov Mentacao',
            'cpf'        => '38399780930',
            'cep'        => '88700000',
            'numero'     => '10',
            'logradouro' => 'Rua Luiz Dammer',
            'bairro'     => 'Flor da Serra',
            'estado'     => 'SC',
            'municipio'  => 'Videira',
        ];

        $pessoaFromDB = Pessoas::create($pessoa);

        $conta = [
            'id_pessoa' => $pessoaFromDB->id,
            'conta'     => '13131313'
        ];

        $contaFromDB = Conta::create($conta);

        $movimentacao = [
            'id_pessoa' => $pessoaFromDB->id,
            'id_conta'  => $contaFromDB->id,
            'valor'     => '300',
            'tipo'      => 'depositar'
        ];

        $cadatroMovimentacao = Livewire::test(Movimentacao::class);
        $cadatroMovimentacao->set($movimentacao)->call('save');

        $this->assertDatabaseHas('movimentacao', $movimentacao);
    }

    /** @test */
    public function saldo_insuficiente_movimentacao_test()
    {
        $pessoa = [
            'nome'       => 'Catarina Melani',
            'cpf'        => '38399780930',
            'cep'        => '88700000',
            'numero'     => '10',
            'logradouro' => 'Rua Luiz Dammer',
            'bairro'     => 'Flor da Serra',
            'estado'     => 'SC',
            'municipio'  => 'Videira',
        ];

        $pessoaFromDB = Pessoas::create($pessoa);

        $conta = [
            'id_pessoa' => $pessoaFromDB->id,
            'conta'     => '19181715'
        ];

        $contaFromDB = Conta::create($conta);

        $movimentacao = [
            'id_pessoa' => $pessoaFromDB->id,
            'id_conta'  => $contaFromDB->id,
            'valor'     => 300,
            'tipo'      => 'retirar'
        ];

        $cadatroMovimentacao = Livewire::test(Movimentacao::class);
        $cadatroMovimentacao
            ->set('saldo', 100)
            ->set($movimentacao)
            ->call('save');

        $this->assertDatabaseMissing('movimentacao', $movimentacao);
    }

    
}
