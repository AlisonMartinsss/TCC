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
        Schema::create('anotacoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('contato_id');
            $table->string('descricao');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('contato_id')->references('id')->on('contatos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('anotacoes');
    }
};
