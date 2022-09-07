<?php

namespace App\Http\Livewire;

use App\Models\Pessoas;
use App\Models\Conta;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Pessoa extends Component
{
    use LivewireAlert;

    public $pessoas;
    public $id_pessoa;
    public $pessoa;

    public function mount()
    {
        $this->pessoas = Pessoas::all();
    }

    public function render()
    {
        return view('livewire.pessoa');
    }

    public function delete($id)
    {
        $conta = Conta::where('id_pessoa', $id)->get();

        if(count($conta) > 0){
            $this->alert('error', 'Não é possível excluir pessoa com conta vinculada.');
        }else {
            $pessoa = Pessoas::find($id);
            if ($pessoa->delete()) {
                $this->alert('success', 'Excluido com sucesso!');
                $this->limpar();
            } else {
                $this->alert('error', 'Houve um problema ao excluir Pessoa, por favor tente novamente mais tarde!');
            }
        }
    }

    public function limpar()
    {
        $this->mount();
    }
}
