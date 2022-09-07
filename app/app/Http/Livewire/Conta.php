<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Conta as ContaModel; 
use App\Models\Pessoas; 
use App\Models\Movimentacao; 
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Conta extends Component
{
    use LivewireAlert;

    public $id_pessoa;
    public $conta;

    public function mount()
    {
        $contas = ContaModel::all();

        foreach($contas as $conta) {
            $conta->pessoa = Pessoas::find($conta->id_pessoa);
        }

        $this->contas = $contas;
    }

    public function render()
    {
        return view('livewire.conta');
    }

    public function delete($id)
    {

        $movimentacao = Movimentacao::where('id_conta', $id)->get();

        if(count($movimentacao) > 0) {
            $this->alert('error', 'Não é possível excluir contas que possuam movimentação!');
        } else {
            $conta = ContaModel::find($id);
            $conta->delete();
            $this->mount();
            $this->alert('success', 'Excluido com Sucesso');
        }


    }
}
