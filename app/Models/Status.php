<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public $table = 'status';
    const DEMANDA = 1;
    const MATERIAL_RECEBIDO = 2;
    const CONFERENCIA = 3;
    const CONFERIDO = 4;
}
