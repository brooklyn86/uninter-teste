<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    public $table = 'curso';
    public $timestamps = false;
    protected $fillable = ['id_curso', 'curso'];
    
}
