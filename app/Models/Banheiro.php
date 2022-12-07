<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banheiro extends Model{
    protected $table = 'banheiros';
    protected $fillable = ['id', 'quantidade'];
}
