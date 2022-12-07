<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\IndexController::class, 'index'])->name('site.index');

Route::get('/busca', [\App\Http\Controllers\BuscaController::class, 'index'])->name('site.busca');
Route::post('/busca', [\App\Http\Controllers\BuscaController::class, 'buscar'])->name('site.busca');
Route::post('/imovel/{id}', [\App\Http\Controllers\BuscaController::class, 'imovel'])->name('site.busca.imovel');

Route::get('/imovel/{id}', [\App\Http\Controllers\ImovelController::class, 'imovel'])->name('site.imovel.detalhe');
Route::post('/imovel', [\App\Http\Controllers\ImovelController::class, 'interesse'])->name('site.imovel');

Route::get('/sobre', [\App\Http\Controllers\SobreController::class, 'index'])->name('site.sobre');

Route::get('/mensagem', [\App\Http\Controllers\MensagemController::class, 'index'])->name('site.mensagem');
Route::post('/mensagem', [\App\Http\Controllers\MensagemController::class, 'salvar'])->name('site.mensagem');

Route::get('/politica', [\App\Http\Controllers\PoliticaController::class, 'index'])->name('site.politica');

Route::get('/login/{erro?}', [\App\Http\Controllers\LoginController::class, 'index'])->name('site.login');
Route::post('/login', [\App\Http\Controllers\LoginController::class, 'login'])->name('site.login');

Route::middleware('acesso')->prefix('/app')->group(function(){

    Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('app.home');

    Route::get('/contato', [\App\Http\Controllers\ContatoController::class, 'index'])->name('app.contato');
    Route::get('/contato/consultar', [\App\Http\Controllers\ContatoController::class, 'consultar'])->name('app.contato.consultar');
    Route::post('/contato/consultar', [\App\Http\Controllers\ContatoController::class, 'consultar'])->name('app.contato.consultar');
    Route::get('/contato/cadastrar', [\App\Http\Controllers\ContatoController::class, 'cadastrar'])->name('app.contato.cadastrar');
    Route::post('/contato/cadastrar', [\App\Http\Controllers\ContatoController::class, 'cadastrar'])->name('app.contato.cadastrar');
    Route::get('/contato/{id}', [\App\Http\Controllers\ContatoController::class, 'exibir'])->name('app.contato.exibir');
    Route::get('/contato/editar/{id}', [\App\Http\Controllers\ContatoController::class, 'editar'])->name('app.contato.editar');
    Route::get('/contato/excluir/{id}', [\App\Http\Controllers\ContatoController::class, 'excluir'])->name('app.contato.excluir');

    Route::get('/tarefa', [\App\Http\Controllers\TarefaController::class, 'index'])->name('app.tarefa');
    Route::get('/tarefa/cadastrar/{id}', [\App\Http\Controllers\TarefaController::class, 'cadastrar'])->name('app.tarefa.cadastrar');
    Route::post('/tarefa/cadastrar', [\App\Http\Controllers\TarefaController::class, 'salvar'])->name('app.tarefa.salvar');
    Route::get('/tarefa/concluir/{id}', [\App\Http\Controllers\TarefaController::class, 'concluir'])->name('app.tarefa.concluir');
    Route::get('/tarefa/editar/{id}', [\App\Http\Controllers\TarefaController::class, 'editar'])->name('app.tarefa.editar');
    Route::get('/tarefa/excluir/{id}', [\App\Http\Controllers\TarefaController::class, 'excluir'])->name('app.tarefa.excluir');

    Route::get('/anotacao/cadastrar/{id}', [\App\Http\Controllers\AnotacaoController::class, 'cadastrar'])->name('app.anotacao.cadastrar');
    Route::post('/anotacao/cadastrar', [\App\Http\Controllers\AnotacaoController::class, 'salvar'])->name('app.anotacao.salvar');
    Route::get('/anotacao/excluir/{id}', [\App\Http\Controllers\AnotacaoController::class, 'excluir'])->name('app.anotacao.excluir');

    Route::middleware('status')->group(function () {

        Route::get('/imovel', [\App\Http\Controllers\ImovelController::class, 'principal'])->name('app.imovel');
        Route::get('/imovel/consultar', [\App\Http\Controllers\ImovelController::class, 'consultar'])->name('app.imovel.consultar');
        Route::post('/imovel/consultar', [\App\Http\Controllers\ImovelController::class, 'consultar'])->name('app.imovel.consultar');
        Route::get('/imovel/cadastrar', [\App\Http\Controllers\ImovelController::class, 'cadastrar'])->name('app.imovel.cadastrar');
        Route::post('/imovel/cadastrar', [\App\Http\Controllers\ImovelController::class, 'cadastrar'])->name('app.imovel.cadastrar');
        Route::get('/imovel/editar/{id}', [\App\Http\Controllers\ImovelController::class, 'editar'])->name('app.imovel.editar');
        Route::get('/imovel/excluir/{id}', [\App\Http\Controllers\ImovelController::class, 'excluir'])->name('app.imovel.excluir');

        Route::get('/mensagem', [\App\Http\Controllers\MensagemController::class, 'principal'])->name('app.mensagem');
        Route::get('/mensagem/{id}', [\App\Http\Controllers\MensagemController::class, 'exibir'])->name('app.mensagem.exibir');
        Route::get('/mensagem/concluir/{id}', [\App\Http\Controllers\MensagemController::class, 'concluir'])->name('app.mensagem.concluir');
        Route::get('/mensagem/excluir/{id}', [\App\Http\Controllers\MensagemController::class, 'excluir'])->name('app.mensagem.excluir');

    });

    Route::get('/perfil', [\App\Http\Controllers\PerfilController::class, 'index'])->name('app.perfil');
    Route::get('/perfil/editar/{id}', [\App\Http\Controllers\PerfilController::class, 'editar'])->name('app.perfil.editar');
    Route::post('/perfil', [\App\Http\Controllers\PerfilController::class, 'salvar'])->name('app.perfil.salvar');

    Route::get('/sair', [\App\Http\Controllers\LoginController::class, 'sair'])->name('app.sair');
});
