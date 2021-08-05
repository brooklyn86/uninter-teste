<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CardProfessor extends Model
{
    public $table = 'card_professor';
    public $timestamps = false;
    protected $primaryKey = 'id_card_professor';
    
    protected $fillable = ['id_card_professor', 'id_card', 'id_professor'];
}
