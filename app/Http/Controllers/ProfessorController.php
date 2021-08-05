<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professor;
use DB;
class ProfessorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $professores = Professor::paginate(10);

        return view('professor.list', compact('professores'));
    }

    public function list(Request $request)
    {
        $input = $request->all();

        $professores = Professor::where('nome', 'like', '%'.$input['query'].'%')->select('professor.id_professor as data', 'professor.nome as value')->get();

        return Response()->json(['suggestions' => $professores]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('professor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
    
            //Recupera os dados do formulário
            $dataForm = $request->all();
            $createPost = Professor::create($dataForm);

            if($createPost){
                DB::commit();
                return Redirect()->back()->with('success', 'Sucesso ao criar um novo professor');
            }
            DB::rollBack();
            return Redirect()->back()->with('error','Falha ao criar um novo professor');

        } catch (\Throwable $th) {
            DB::rollBack();

            return Redirect()->back()->with('error','Falha ao criar um novo professor');
        }
    }

   
}
