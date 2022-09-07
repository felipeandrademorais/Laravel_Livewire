<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Conta; 
use App\Models\Pessoas;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class CadastroConta extends Component
{
    use LivewireAlert;

    public $pessoas;
    public $id_conta;
    public $id_pessoa;
    public $conta;
    public $acao_botao = 'save';
    public $botao = 'Salvar';

    protected $rules = [
        'conta' => 'required',
    ];

    protected $messages = [
        'conta.required' => 'Conta é um campo obrigatório.',
    ];


    public function mount($id = 0) 
    {
        $conta = Conta::find($id);
        $this->pessoas = Pessoas::all();
        
        if( $id != 0 ) {
            $this->id_conta = $conta->id;
            $this->id_pessoa = $conta->id_pessoa;
            $this->conta = $conta->conta;
            $this->acao_botao = 'update';
            $this->botao = 'Editar';
        }
    }

    public function render()
    {
        return view('livewire.cadastro-conta');
    }

    public function save()
    {
        $this->validate();
        
        if($this->verificaConta()){
            Conta::create([
                'id_pessoa' => $this->id_pessoa,
                'conta' => $this->conta,
            ]);        
    
            $this->id_pessoa = '';
            $this->conta = '';
            
            $this->alert('success', 'Cadastrado com Sucesso!');
        }
    }

    public function update()
    {
        $this->validate();
        $conta = Conta::find($this->id_conta);

        if($this->verificaConta()){
            $conta->update([
                'id_pessoa' => $this->id_pessoa,
                'conta' => $this->conta,
            ]);  

            return redirect()->to('/conta');
        }
    }

    public function verificaConta()
    {
        $conta = Conta::where('conta', $this->conta)->get();

        if(count($conta) > 0) {
            $this->alert('error', 'Essa conta já existe, insira uma conta diferente.');
            return false;
        }

        return true;
    }
}
