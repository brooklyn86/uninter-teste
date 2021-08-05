<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use DB;
class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cursos = Curso::paginate(10);

        return view('cursos.list', compact('cursos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cursos.create');
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
            $createPost = Curso::create($dataForm);

            if($createPost){
                DB::commit();
                return Redirect()->back()->with('success', 'Sucesso ao criar um novo curso');
            }
            DB::rollBack();
            return Redirect()->back()->with('error','Falha ao criar um novo curso');

        } catch (\Throwable $th) {
            DB::rollBack();
            
            return Redirect()->back()->with('error','Falha ao criar um novo curso');
        }
    }

}
