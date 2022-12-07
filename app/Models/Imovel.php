<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imovel extends Model{
    protected $table = 'imoveis';
    protected $fillable = [
        'estado_id', 'estagio_id', 'finalidade_id', 'tipo_id', 'localizacao_id', 'banheiro_id', 'dormitorio_id',
        'vaga_id', 'nome', 'url_mapa', 'destaque_id', 'valor', 'entrada_minima_porcentagem', 'descricao', 'detalhes',
        'caracteristicas', 'foto_principal', 'fotos', 'metragem_util', 'metragem_total'
    ];
    protected $casts = [
        'detalhes' => 'array',
        'caracteristicas' => 'array',
        'fotos' => 'array'
    ];

    public function estagio(){
        return $this->belongsTo('App\Models\Estagio');
    }

    public function localizacao(){
        return $this->belongsTo('App\Models\Localizacao');
    }

    public function tipo(){
        return $this->belongsTo('App\Models\Tipo');
    }

    public function banheiro(){
        return $this->belongsTo('App\Models\Banheiro');
    }

    public function dormitorio(){
        return $this->belongsTo('App\Models\Dormitorio');
    }

    public function vaga(){
        return $this->belongsTo('App\Models\Vaga');
    }
}
