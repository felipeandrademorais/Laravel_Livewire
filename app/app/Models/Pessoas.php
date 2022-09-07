<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\SanitizeTrait;

class Pessoas extends Model
{
    use HasFactory;
    use SanitizeTrait;
    
    public $timestamps = false;
    protected $fillable = [
        'nome',
        'cpf',
        'cep',
        'numero',
        'logradouro',
        'bairro',
        'estado',
        'municipio'
    ];

    public function sanitizar()
    {
        $this->cep = $this->sanitize($this->cep); 
        $this->cpf = $this->sanitize($this->cpf); 
    }
}
