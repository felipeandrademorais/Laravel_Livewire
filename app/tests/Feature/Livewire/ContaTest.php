<?php

namespace Tests\Feature\Livewire;

use App\Http\Livewire\CadastroConta;
use App\Http\Livewire\Conta;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;
use App\Models\Pessoas;
use App\Models\Conta as ContaModel;

class ContaTest extends TestCase
{    
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(Conta::class);
        $component->assertStatus(200);

        $component = Livewire::test(CadastroConta::class);
        $component->assertStatus(200);
    }

    /** @test */
    public function salvar_conta_test()
    {
        $pessoa = [
            'nome'       => 'lorem Alberto',
            'cpf'        => '38349781930',
            'cep'        => '88600001',
            'numero'     => '10',
            'logradouro' => 'Rua Demo Luiz',
            'bairro'     => 'Contagem',
            'estado'     => 'SC',
            'municipio'  => 'Florianopolis',
        ];

        $pessoaFromDB = Pessoas::create($pessoa);

        $conta = [
            'id_pessoa' => $pessoaFromDB->id,
            'conta'     => '123456789'
        ];

        $cadatroConta = Livewire::test(CadastroConta::class);
        $cadatroConta->set($conta)->call('save');

        $this->assertDatabaseHas('conta', $conta);

        $conta['conta'] = '000000000';

        $this->assertDatabaseMissing('conta', $conta);
    }
 
    /** @test */
    public function upload_conta_test()
    {
        $pessoa = [
            'nome'       => 'Francisco de Solza',
            'cpf'        => '38341231930',
            'cep'        => '89600000',
            'numero'     => '10',
            'logradouro' => 'Rua Demo Luiz',
            'bairro'     => 'Contagem',
            'estado'     => 'SC',
            'municipio'  => 'Joacaba',
        ];

        $pessoaFromDB = Pessoas::create($pessoa);

        $conta = [
            'id_pessoa' => $pessoaFromDB->id,
            'conta'     => '123456789'
        ];

        $contaFromDB = ContaModel::create($conta);

        $conta['conta'] = '0102030405';

        $cadatroConta = Livewire::test(CadastroConta::class);
        $cadatroConta
            ->set('id_conta', $contaFromDB->id)
            ->set($conta)
            ->call('update');

        $this->assertDatabaseHas('conta', $conta);
    }
 
    /** @test */
    public function elementos_obrigatorios_conta_test()
    {
        $pessoa = [
            'nome'       => 'Elem Obriga',
            'cpf'        => '38390071930',
            'cep'        => '89600000',
            'numero'     => '10',
            'logradouro' => 'Av Rio Branco',
            'bairro'     => 'Centro',
            'estado'     => 'SC',
            'municipio'  => 'Joacaba',
        ];

        $pessoaFromDB = Pessoas::create($pessoa);

        $conta = [
            'id_pessoa' => $pessoaFromDB->id,
        ];

        $cadatroConta = Livewire::test(CadastroConta::class);
        $cadatroConta
            ->set($conta)
            ->call('save')
            ->assertHasErrors([
                'conta' => 'required',
            ]);
    }
}
