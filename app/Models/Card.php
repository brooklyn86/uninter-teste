<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CardMaterial;
use App\Models\Material;
class Card extends Model
{
    public $table = 'card';
    public $timestamps = false;
    protected $primaryKey = 'id_card';
    protected $fillable = ['id_card', 'id_tipo', 'id_curso', 'id_status', 'dt_registro', 'ano', 'num_aula'];


    public function materiais(){
        return $this->belongsToMany(Material::class,'card_material', 'id_card', 'id_material');
    }

    public function professores(){
        return $this->belongsToMany(Professor::class,'card_professor', 'id_card', 'id_professor');
    }
}
