<?php

namespace App\Repositories;

use App\Models\Pessoas;
use Illuminate\Support\Facades\DB;

class PessoasRepository extends Pessoas
{
    public function getPessoasComConta()
    {
        $pessoas = DB::table('pessoas')
            ->join('conta', 'conta.id_pessoa', '=', 'pessoas.id')->get();

        return $pessoas;
    }
}
