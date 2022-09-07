<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimentacao extends Model
{
    use HasFactory;

    protected $table = 'movimentacao';
    
    protected $fillable = [
        'id_pessoa',
        'id_conta',
        'valor',
        'tipo',
        'created_at',
    ];

    public function pessoa()
    {
        return $this->belongsTo(Pessoas::class, 'id_pessoa', 'id');
    }

    public function conta()
    {
        return $this->belongsTo(Conta::class, 'id_conta', 'id');
    }

    public function atualizaValor()
    {
        if($this->tipo == 'retirar'){
            $this->valor = -abs($this->valor); 
        } 
    }

    public function verificaSaldoDisponivel()
    {
        $saldo = DB::table('movimentacao')
            ->where('movimentacao.id_pessoa', $this->id_pessoa)
            ->sum('valor');

        if($saldo < $this->valor){
            return false;
        }
    }
}
