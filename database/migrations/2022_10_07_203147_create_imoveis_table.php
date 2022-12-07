<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('imoveis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('estado_id');
            $table->unsignedBigInteger('estagio_id');
            $table->unsignedBigInteger('finalidade_id');
            $table->unsignedBigInteger('localizacao_id');
            $table->unsignedBigInteger('tipo_id');
            $table->unsignedBigInteger('banheiro_id');
            $table->unsignedBigInteger('dormitorio_id');
            $table->unsignedBigInteger('vaga_id');
            $table->unsignedBigInteger('destaque_id');
            $table->string('nome');
            $table->text('url_mapa');
            $table->double('valor');
            $table->double('entrada_minima_porcentagem');
            $table->text('descricao');
            $table->json('detalhes');
            $table->json('caracteristicas');
            $table->string('foto_principal');
            $table->json('fotos');
            $table->double('metragem_util');
            $table->double('metragem_total');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('imoveis', function (Blueprint $table) {
            $table->foreign('estado_id')->references('id')->on('estados');
            $table->foreign('estagio_id')->references('id')->on('estagios');
            $table->foreign('finalidade_id')->references('id')->on('finalidades');
            $table->foreign('localizacao_id')->references('id')->on('localizacoes');
            $table->foreign('tipo_id')->references('id')->on('tipos');
            $table->foreign('banheiro_id')->references('id')->on('banheiros');
            $table->foreign('dormitorio_id')->references('id')->on('dormitorios');
            $table->foreign('vaga_id')->references('id')->on('vagas');
            $table->foreign('destaque_id')->references('id')->on('destaques');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('imoveis');
    }
};
