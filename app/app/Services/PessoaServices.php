<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class PessoaServices {

    const CEP_URL = "https://ws.apicep.com/cep/";
    
    public function buscaEnderecoPeloCep($cep) {
        return (Http::get(self::CEP_URL . $cep . '.json'))->json();
    }

}
