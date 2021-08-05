<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professor;
use App\Models\Material;
use App\Models\Curso;
use App\Models\Card;
use App\Models\Status;
class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $material = Material::all();
        $cursos = Curso::all();

        return view('dashboard', compact('material','cursos'));
    }


    public function ajaxCards(Request $request){

        $query = Card::join('curso', 'card.id_curso', 'curso.id_curso')
        ->join('status', 'card.id_status', 'status.id_status')
        ->join('tipo', 'card.id_tipo', 'tipo.id_tipo')
        ->join('card_professor', 'card.id_card', 'card_professor.id_card')
        ->join('professor', 'professor.id_professor', 'card_professor.id_professor')
        ->with('materiais')
        ->with('professores')
        ->whereHas('professores', function($q) use($request){
            if(isset($request->professor) && !empty($request->professor)  && $request->professor != 'undefined'){
                $q->where('professor.id_professor',$request->professor);
            }
        })
        ->where('card.id_status', $request->id);
        if(isset($request->curso) && !empty($request->curso) && $request->curso != 'undefined'){
            $query->where('card.id_curso',$request->curso);
        }
        if(isset($request->id_card) && !empty($request->id_card) && $request->id_card != 'undefined'){
            $query->where('card.id_card',$request->id_card);
        }
        if(isset($request->nAula) && !empty($request->nAula) && $request->nAula != 'undefined'){
            $query->where('card.num_aula',$request->nAula);
        }
        if(isset($request->ordernar) && !empty($request->ordernar) && isset($request->ordem) && !empty($request->ordem)){
            if($request->ordernar != 'professor'){
                $query->orderBy($request->ordernar, $request->ordem);
            }else{
                $query->orderBy('professor.nome', $request->ordem);

            }
        }
        $demanda = $query->groupBy('card.id_card')->distinct()->get();

        $quantidade = $demanda->count();
        return Response()->json(['cards' => $demanda, 'quantidade'=> $quantidade]);
    }

    
}
