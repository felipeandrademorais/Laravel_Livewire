<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\CadastroPessoa;
use App\Http\Livewire\CadastroMovimentacao;
use App\Http\Livewire\CadastroConta;
use App\Http\Livewire\Pessoa;
use App\Http\Livewire\Movimentacao;
use App\Http\Livewire\Conta;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', Pessoa::class)->name('index');

Route::get('/pessoa', Pessoa::class)->name('pessoa');
Route::get('/conta', Conta::class)->name('conta');
Route::get('/movimentacao', Movimentacao::class)->name('movimentacao');

Route::prefix('cadastro')->name('cadastro.')->group(function () {
    Route::get('/pessoa/{id?}', CadastroPessoa::class)->name('pessoa');
    Route::get('/conta/{id?}', CadastroConta::class)->name('conta');
});
