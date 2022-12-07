<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Localizacao extends Model{
    protected $table = 'localizacoes';
    protected $fillable = ['id', 'cidade', 'bairro'];
}
