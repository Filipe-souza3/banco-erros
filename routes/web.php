<?php

use App\Http\Controllers\ClassificacaoController;
use App\Http\Controllers\ImagemController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OcorrenciaController;
use App\Models\Imagem;
use App\Models\Ocorrencia;

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

Route::get('/oi', function () {
    return view('welcome');
});
Route::view('/a', 'index')->name('index');

// Route::view('/resolucao',function($ocorrencia,$classificacao){
//     return view('definir',['ocorrencia'=>$ocorrencia,'classificacao'=>$classificacao]);
// })->name('adm.resolucao');


Route::view('/editar', 'editDefinir')->name('adm.editDefinir');
Route::get('/editar/{classificacao}',[ClassificacaoController::class,'edit'])->name("adm.editar");
Route::get('/exibir/{ocorrencia}',[OcorrenciaController::class,'edit'])->name('adm.exibir');
Route::get('/',[OcorrenciaController::class,'show'])->name('adm.listar');
Route::get('/excluirImg/{imagem}',[ImagemController::class,'destroy'])->name('adm.excluir.img');
Route::get('/excluir/{ocorrencia}',[OcorrenciaController::class,'destroy'])->name('adm.excluir.tudo');
Route::get('/pesquisa',[OcorrenciaController::class,'pesquisar'])->name('lista.pesquisa');

Route::post('/ocorrencia',[OcorrenciaController::class,'store'])->name("ocorrencia.store");
Route::post('/classificacao/{ocorrenciaid}',[ClassificacaoController::class,'store'])->name('classificacao.store');
Route::post('/classificacaoUpdate/{ocorrenciaid}',[ClassificacaoController::class,'update'])->name('classificacao.update');



