<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dormitorio extends Model{
    protected $table = 'dormitorios';
    protected $fillable = ['id', 'quantidade'];
}
