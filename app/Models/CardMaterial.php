<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CardMaterial extends Model
{
    public $table = 'card_material';
    public $timestamps = false;
    protected $fillable = ['id_card_material', 'id_card', 'id_material'];
}
