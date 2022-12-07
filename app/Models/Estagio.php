<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estagio extends Model{
    protected $table = 'estagios';
    protected $fillable = ['id', 'descricao'];
}
