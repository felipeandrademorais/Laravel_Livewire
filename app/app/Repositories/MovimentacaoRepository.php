<?php

namespace App\Repositories;

use App\Models\Movimentacao;
use Illuminate\Support\Facades\DB;

class MovimentacaoRepository extends Movimentacao
{
    public function getMovimentacao($id_pessoa = null)
    {
        $movimentacoes = DB::table('movimentacao')
            ->join('conta', 'conta.id', '=', 'movimentacao.id_conta')
            ->join('pessoas', 'pessoas.id', '=', 'movimentacao.id_pessoa');

        if($id_pessoa){
            $movimentacoes->where('movimentacao.id_pessoa', $id_pessoa);
        }

        return $movimentacoes->get();
    }

    public function getSaldo($id_pessoa)
    {
        $saldo = DB::table('movimentacao')
                    ->where('movimentacao.id_pessoa', $id_pessoa)
                    ->sum('valor');
        
        return $saldo;
    }
}
