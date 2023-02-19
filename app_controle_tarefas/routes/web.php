<?php

use Illuminate\Support\Facades\Route;
use App\Mail\MensagemTesteMail;
use App\Controller\VisitaController;

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

Route::get('/', function () {
    return view('bem-vindo');
});

Auth::routes(['verify' => true]);

/*
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
->name('home')
->middleware('verified');
*/

Route::get('tarefa/exportacao/{extensao}', 'App\Http\Controllers\TarefaController@exportacao')
    ->name('tarefa.exportacao');

Route::get('tarefa/exportar', 'App\Http\Controllers\TarefaController@exportar')
    ->name('tarefa.exportar');

Route::resource('tarefa', 'App\Http\Controllers\TarefaController')
    ->middleware('verified');

Route::resource('visita', 'App\Http\Controllers\VisitaController')
    ->middleware('verified');


Route::get('consult/{id}', 'App\Http\Controllers\VisitaController@consultById')
    ->name('consultById')
    ->middleware('verified');

Route::get('cancel/{id}', 'App\Http\Controllers\VisitaController@cancelById')
    ->name('cancelById')
    ->middleware('verified');


Route::get('/mensagem-teste', function () {
    return new MensagemTesteMail();
    //Mail::to('atendimento@jorgesantana.net.br')->send(new MensagemTesteMail());
    //return 'E-mail enviado com sucesso!';
});