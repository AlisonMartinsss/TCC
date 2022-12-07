<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarefa extends Model{

    protected $table = 'tarefas';
    protected $fillable = ['user_id', 'contato_id', 'status_id', 'assunto', 'descricao', 'data', 'hora'];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function contato(){
        return $this->belongsTo('App\Models\Contato');
    }
}
