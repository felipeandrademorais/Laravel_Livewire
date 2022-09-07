<?php

namespace Tests\Feature\Livewire;

use App\Http\Livewire\CadastroPessoa;
use App\Http\Livewire\Pessoa;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;
use App\Models\Pessoas;

class PessoaTest extends TestCase
{
    /** @test */
    public function the_components_can_render()
    {
        $component = Livewire::test(Pessoa::class);
        $component->assertStatus(200);

        $component = Livewire::test(CadastroPessoa::class);
        $component->assertStatus(200);
    }

    /** @test */
    public function salvar_pessoa_test()
    {
        $pessoa = [
            'nome'       => 'José Alberto',
            'cpf'        => '38349981930',
            'cep'        => '88705001',
            'numero'     => '10',
            'logradouro' => 'Rua Luiz Demo',
            'bairro'     => 'Passagem',
            'estado'     => 'SC',
            'municipio'  => 'Tubarão',
        ];

        $cadatroPessoa = Livewire::test(CadastroPessoa::class);
        $cadatroPessoa->set($pessoa)->call('save');

        $this->assertDatabaseHas('pessoas', $pessoa);

        $pessoa['nome'] = 'Felipe Morais';

        $this->assertDatabaseMissing('pessoas', $pessoa);
    }

    /** @test */
    public function upload_pessoa_test()
    {
        $pessoa = [
            'nome'       => 'Ricardo Eletro',
            'cpf'        => '49349661930',
            'cep'        => '88705001',
            'numero'     => '10',
            'logradouro' => 'Rua Luiz Demo',
            'bairro'     => 'Passagem',
            'estado'     => 'SC',
            'municipio'  => 'Tubarão',
        ];

        $pessoaFromDB = Pessoas::create($pessoa);

        $this->assertDatabaseHas('pessoas', $pessoa);

        $pessoa['nome'] = 'Mario Bros';

        $cadatroPessoa = Livewire::test(CadastroPessoa::class);
        $cadatroPessoa
            ->set('id_pessoa', $pessoaFromDB->id)
            ->set($pessoa)
            ->call('update');

        $this->assertDatabaseHas('pessoas', $pessoa);
    }

    /** @test */
    public function elementos_obrigatorios_pessoa_test()
    {
        $pessoa = [
            'numero'     => '10',
            'logradouro' => 'Rua Luiz Demo',
            'bairro'     => 'Passagem',
            'estado'     => 'SC',
            'municipio'  => 'Tubarão',
        ];

        $cadatroPessoa = Livewire::test(CadastroPessoa::class);
        $cadatroPessoa
            ->set($pessoa)
            ->call('save')
            ->assertHasErrors([
                'nome' => 'required',
                'cpf'  => 'required',
                'cep'  => 'required',
            ]);
    }

}
