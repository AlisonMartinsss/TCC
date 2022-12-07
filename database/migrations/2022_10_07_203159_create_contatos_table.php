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
        Schema::create('contatos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fonte_id')->default(1);
            $table->unsignedBigInteger('localizacao_id');
            $table->unsignedBigInteger('situacao_id')->default(1);
            $table->unsignedBigInteger('tipo_id');
            $table->unsignedBigInteger('user_id');
            $table->string('nome');
            $table->string('telefone')->unique();
            $table->string('email');
            $table->timestamps();
        });

        Schema::table('contatos', function (Blueprint $table) {
            $table->foreign('fonte_id')->references('id')->on('fontes');
            $table->foreign('localizacao_id')->references('id')->on('localizacoes');
            $table->foreign('situacao_id')->references('id')->on('situacoes');
            $table->foreign('tipo_id')->references('id')->on('tipos');
            $table->foreign('user_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('contatos');
    }
};
