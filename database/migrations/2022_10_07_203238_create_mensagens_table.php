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
        Schema::create('mensagens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('assunto_id');
            $table->unsignedBigInteger('status_id')->default(1);
            $table->string('nome');
            $table->string('email');
            $table->string('telefone');
            $table->string('descricao');
            $table->timestamps();
        });

        Schema::table('mensagens', function (Blueprint $table) {
            $table->foreign('assunto_id')->references('id')->on('assuntos');
            $table->foreign('status_id')->references('id')->on('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('mensagens');
    }
};
