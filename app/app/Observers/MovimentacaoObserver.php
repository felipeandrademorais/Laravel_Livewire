<?php

namespace App\Observers;

use App\Models\Movimentacao;

class MovimentacaoObserver
{
    /**
     * Handle the Movimentacao "created" event.
     *
     * @param  \App\Models\Movimentacao  $movimentacao
     * @return void
     */
    public function saving(Movimentacao $movimentacao)
    {
        $movimentacao->atualizaValor();
    }
}
