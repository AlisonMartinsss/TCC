<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensagem extends Model{
    protected $table = 'mensagens';
    protected $fillable = ['nome', 'email', 'telefone', 'assunto_id', 'status_id', 'descricao'];

    public function assunto(){
        return $this->belongsTo('App\Models\Assunto');
    }
}
