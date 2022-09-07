<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Movimentacao as MovimentacaoModel; 
use App\Models\Pessoas;
use App\Models\Conta;
use App\Repositories\MovimentacaoRepository;
use App\Repositories\PessoasRepository;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Movimentacao extends Component
{
    use LivewireAlert;

    public $id_pessoa;
    public $id_conta;
    public $valor;
    public $tipo;
    public $saldo;
    public $acao_botao = 'save';
    public $botao = 'Salvar';

    private $movRepository;

    protected $rules = [
        'id_pessoa' => 'required',
        'id_conta' => 'required',
        'tipo' => 'required',
        'valor' => 'required'
    ];

    protected $messages = [
        'id_pessoa.required' => 'Pessoa é um campo obrigatório.',
        'id_conta.required' => 'Número da Conta é um campo obrigatório.',
        'valor.required' => 'Informe o valor que deseja movimentar.',
        'tipo.required' => 'Informar se deseja retirar ou depositar.'
    ];

    public function mount()
    {
        $this->movRepository = new MovimentacaoRepository();
        $this->movimentacoes = $this->movRepository->getMovimentacao($this->id_pessoa);
        
        $pessoaRepository = new PessoasRepository();
        $this->pessoas = $pessoaRepository->getPessoasComConta();

        $this->contas = $this->getContaByPessoa();
        $this->atualizaSaldo();

    }

    public function render()
    {
        return view('livewire.movimentacao');
    }

    public function save()
    {
        $this->atualizaSaldo();
        $saldo = $this->saldo;
        $id_pessoa = $this->id_pessoa;
        $id_conta = $this->id_conta;
        $tipo = $this->tipo;
        $valor = $this->valor;

        if((($saldo < $this->valor) && ($this->tipo == 'retirar'))){
            $this->alert('error', 'Você não possui saldo suficiente!');
            $this->limpar();
            return false;
        }

        MovimentacaoModel::create([
            'id_pessoa' => $id_pessoa,
            'id_conta' => $id_conta,
            'tipo' => $tipo,
            'valor' => $valor, 
        ]);     
    
        $this->limpar();
    }

    public function updatedIdPessoa()
    {
        $this->mount();
        $this->atualizaSaldo();
    }

    public function updatedIdConta()
    {
        $this->atualizaSaldo();
    }

    private function getContaByPessoa()
    {   
        $contas = [];

        if($this->id_pessoa) {
            $contas = Conta::where('id_pessoa', $this->id_pessoa)->get();
        }

        return $contas;
    }


    private function atualizaSaldo()
    {

        if($this->id_pessoa){
            $this->movRepository = new MovimentacaoRepository();
            $saldo = $this->movRepository->getSaldo($this->id_pessoa);
            if( $saldo ) {
                $this->saldo = $saldo;
            } else {
                $this->saldo = 0;
            }
        }
    }

    private function limpar()
    {
        $this->mount();

        $this->id_pessoa = ''; 
        $this->id_conta = '';
        $this->tipo = '';
        $this->valor = '';
    }
}
