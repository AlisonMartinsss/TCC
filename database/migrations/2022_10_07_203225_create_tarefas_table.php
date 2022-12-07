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
        Schema::create('tarefas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('contato_id');
            $table->foreignId('status_id')->default(1);
            $table->string('assunto');
            $table->string('descricao');
            $table->date('data');
            $table->time('hora');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('contato_id')->references('id')->on('contatos');
            $table->foreign('status_id')->references('id')->on('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('tarefas');
    }
};
