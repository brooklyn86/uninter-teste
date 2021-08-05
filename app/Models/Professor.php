<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    public $table = 'professor';
    public $timestamps = false;
    protected $primaryKey = 'id_professor';
    protected $fillable = ['id_professor', 'nome'];
}
