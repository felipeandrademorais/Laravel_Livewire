<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Pessoas; 
use App\Services\PessoaServices;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class CadastroPessoa extends Component
{
    use LivewireAlert;

    public $id_pessoa;
    public $nome;
    public $cpf;
    public $cep;
    public $numero;
    public $logradouro;
    public $bairro;
    public $estado; 
    public $municipio;
    public $acao_botao;
    public $botao;

    public function mount($id = 0) 
    {
        $pessoa = Pessoas::find($id);

        $this->acao_botao = 'save';
        $this->botao = 'Salvar';
        
        if( $id != 0 ) {
            $this->id_pessoa = $pessoa->id;
            $this->nome = $pessoa->nome;
            $this->cpf = $pessoa->cpf;
            $this->cep = $pessoa->cep;
            $this->numero = $pessoa->numero;
            $this->logradouro = $pessoa->logradouro;
            $this->bairro = $pessoa->bairro;
            $this->estado = $pessoa->estado;
            $this->municipio = $pessoa->municipio;
            $this->acao_botao = 'update';
            $this->botao = 'Editar';
        }
    }

    public function render()
    {
        return view('livewire.cadastro-pessoa');
    }

    protected $rules = [
        'nome' => 'required',
        'cpf' => 'required',
        'cep' => 'required',
    ];

    protected $messages = [
        'nome.required' => 'Nome é um campo obrigatório.',
        'cpf.required' => 'CPF é um campo obrigatório.',
        'cep.required' => 'CEP é um campo obrigatório.',
    ];

    public function save()
    {
        $this->validate();

        Pessoas::create([
            'nome' => $this->nome,
            'cpf' => $this->cpf,
            'cep' => $this->cep,
            'numero' => $this->numero,
            'logradouro' => $this->logradouro,
            'bairro' => $this->bairro,
            'estado' => $this->estado,
            'municipio' => $this->municipio
        ]);        

        $this->nome = '';
        $this->cpf = '';
        $this->cep = '';
        $this->numero = '';
        $this->logradouro = '';
        $this->bairro = '';
        $this->estado = '';
        $this->municipio = '';

        $this->alert('success', 'Cadastrado com Sucesso!');
    }

    public function update()
    {
        $this->validate();
        
        $pessoa = Pessoas::find($this->id_pessoa);

        $pessoa->update([
            'nome' => $this->nome,
            'cpf' => $this->cpf,
            'cep' => $this->cep,
            'numero' => $this->numero,
            'logradouro' => $this->logradouro,
            'bairro' => $this->bairro,
            'estado' => $this->estado,
            'municipio' => $this->municipio
        ]);  

        $this->alert('success', 'Atualizado com Sucesso!');
    }

    public function updatedCep() 
    {
        if(strlen($this->cep) >= 8){
            $pessoaService = new PessoaServices();
            $endereco = $pessoaService->buscaEnderecoPeloCep($this->cep);
            if($endereco["ok"]) {
                $this->cep = '';
                
                $this->cep = $endereco["code"];
                $this->estado = $endereco["state"];
                $this->municipio = $endereco["city"];
                $this->logradouro = $endereco["address"];
                $this->bairro = $endereco["district"];
            }
        }
    }
}
