<?php

namespace App\Observers;

use App\Models\Pessoas;

class PessoaObserver
{
    /**
     * Handle the Pessoa "created" event.
     *
     * @param  \App\Models\Pessoas  $pessoas
     * @return void
     */
    public function saving(Pessoas $pessoas)
    {
        $pessoas->sanitizar();
    }
}
