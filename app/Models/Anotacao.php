<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anotacao extends Model{

    protected $table = 'anotacoes';
    protected $fillable = ['user_id', 'contato_id', 'descricao'];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function contato(){
        return $this->belongsTo('App\Models\Contato');
    }
}
