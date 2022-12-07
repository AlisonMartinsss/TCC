<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contato extends Model{
    protected $table = 'contatos';
    protected $fillable = ['nome', 'telefone', 'email', 'tipo_id', 'localizacao_id', 'situacao_id', 'fonte_id', 'user_id'];

    public function situacao(){
        return $this->belongsTo('App\Models\Situacao');
    }

    public function localizacao(){
        return $this->belongsTo('App\Models\Localizacao');
    }

    public function tipo(){
        return $this->belongsTo('App\Models\Tipo');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function fonte(){
        return $this->belongsTo('App\Models\Fonte');
    }
}
