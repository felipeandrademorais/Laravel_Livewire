<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conta extends Model
{
    use HasFactory;

    protected $table = 'conta';

    public $timestamps = false;
    
    protected $fillable = [
        'id_pessoa',
        'conta',
        'created_at'
    ];

    public function pessoa()
    {
        return $this->belongsTo(Pessoas::class, 'id_pessoa', 'id');
    }

    public function saldo()
    {
        $saldo = Conta::join(
            'movimentacao', 
            'movimentacao.id_conta', 
            '=', 
            'conta.id'
        )->groupBy(
            'movimentacao.id_conta'
        )->sum('valor');

        return $saldo;
    }
}
