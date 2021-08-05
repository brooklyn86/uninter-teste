<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Card;
use App\Models\CardMaterial;
use App\Models\CardProfessor;
use App\Models\Curso;
use App\Models\Material;
use App\Models\Professor;
use App\Models\CardMovimentacao;
use App\Models\Status;
use App\Models\Type;
use DB;
class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $cards = Card::join('curso', 'card.id_curso', 'curso.id_curso')
        ->join('status', 'card.id_status', 'status.id_status')
        ->join('tipo', 'card.id_tipo', 'tipo.id_tipo')
        ->with('materiais')->with('professores')->paginate(10);
        return view('card.list', compact('cards'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {    

        $cursos = Curso::all();
        $types = Type::all();
        return view('card.create', compact('cursos', 'types'));
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
            $dataForm['dt_registro'] = \Carbon\Carbon::now();
            $dataForm['ano'] = date('Y');
            $dataForm['id_status'] = 1;
            $createCard = Card::create($dataForm);

            if($createCard){
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

    public function viewCadastroMaterial(Request $request)
    {
        $card = Card::where('id_card', $request->id)->first();
        if(!$card){
            return Redirect()->back()->with('error','Falha ao encontrar o card informado');
        }
        $materiais = Material::all();
        return view('card.add_material.index', compact('card', 'materiais'));


    }
    public function cadastroMaterial(Request $request)
    {
        $card = Card::where('id_card', $request->id_card)->exists();

        if($card){
            try {
                DB::beginTransaction();
                //Recupera os dados do formulário
                $dataForm = $request->all();
                $createCardMaterial = CardMaterial::create($dataForm);
    
                if($createCardMaterial){
                    DB::commit();
                    return Redirect()->back()->with('success', 'Sucesso ao criar um novo material');
                }
                DB::rollBack();
                return Redirect()->back()->with('error','Falha ao criar um novo material');
    
            } catch (\Throwable $th) {
                DB::rollBack();
                return Redirect()->back()->with('error','Falha ao criar um novo material');
            }
        }
        return Redirect()->back()->with('error','Falha ao criar um novo material');


    }
    public function viewCadastroProfessor(Request $request)
    {
        $card = Card::where('id_card', $request->id)->first();
        if(!$card){
            return Redirect()->back()->with('error','Falha ao encontrar o card informado');
        }
        $professores = Professor::all();
        return view('card.add_professor.index', compact('card', 'professores'));


    }
    public function cadastroProfessor(Request $request)
    {
        $card = Card::where('id_card', $request->id_card)->exists();

        if($card){
            try {
                DB::beginTransaction();
                //Recupera os dados do formulário
                $dataForm = $request->all();
                $createCardProfessor = CardProfessor::create($dataForm);
    
                if($createCardProfessor){
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
        return Redirect()->back()->with('error','Falha ao criar um novo professor');


    }

    public function movimentaCard(Request $request){
        try {
            $movimentação = CardMovimentacao::where('id_card', $request->id_card)->exists();
        $card = Card::where('id_card', $request->id_card)->first();

        $newMovimentacao = null;
        if($movimentação){
            $movimentação = CardMovimentacao::where('id_card', $request->id_card)->orderBy('id_card_movimentacao', 'desc')->first();
            $dt_registro = \Carbon\Carbon::create($movimentação->dt_registro);
            $diffMinutes = $dt_registro->diffInSeconds(\Carbon\Carbon::now());

            if($card->professores()->count() == 0){ 
                return Redirect()->back()->with('error','Nenhuma ação foi realizada');
            }
            if($movimentação->id_status == Status::CONFERENCIA && $diffMinutes <= 60){ 
                return Redirect()->back()->with('error','Nenhuma ação foi realizada aguarde o tempo de resolução');
            }

                if($movimentação->id_status == Status::DEMANDA){
                    if($request->tipo == 'next'){
                        $card->id_status =Status::MATERIAL_RECEBIDO;
                        $card->save();
                    }else{
                        return Redirect()->back()->with('error','Ação não permitida');
                    }
                }
                if($movimentação->id_status == Status::MATERIAL_RECEBIDO){
                    if($request->tipo == 'next'){
                        if($card->professores()->count() > 1){
                            $card->id_status =Status::CONFERENCIA;
                        }else{
                            $card->id_status =Status::CONFERIDO;
                        }
                        $card->save();
                    }else{
                        $card->id_status =Status::DEMANDA;
                        $card->save();
                    }
                }
                if($card->professores()->count() > 1){
          
                    if($movimentação->id_status == Status::CONFERENCIA){
                        if($request->tipo == 'next'){
                            $card->id_status =Status::CONFERIDO;
                            $card->save();
                        }else{
                            $card->id_status =Status::MATERIAL_RECEBIDO;
                            $card->save();
                        }
                    }
                    if($movimentação->id_status == Status::CONFERIDO){

                        if($request->tipo == 'next'){
                            return Redirect()->back()->with('error','Ação não permitida');
                        }else{
                            if($card->professores()->count() > 1){
                                $card->id_status =Status::CONFERENCIA;
                                $card->save();
                            }else{
                                $card->id_status =Status::MATERIAL_RECEBIDO;
                                $card->save();
                            }
                        }
                    }
                }else{
                    if($movimentação->id_status == Status::CONFERIDO){
                        if($request->tipo == 'next'){
                            return Redirect()->back()->with('error','Ação não permitida');
                        }else{
                            $card->id_status =Status::MATERIAL_RECEBIDO;
                            $card->save();
                            
                        }
                    }
                }



                $newMovimentacao = new CardMovimentacao;~
                $newMovimentacao->id_card = $card->id_card;
                $newMovimentacao->id_status = $card->id_status;
                $newMovimentacao->dt_registro = \Carbon\Carbon::now();
                $newMovimentacao->save();

        }else{
            $card->id_status =Status::MATERIAL_RECEBIDO;
            $card->save();
            $newMovimentacao = new CardMovimentacao;~
            $newMovimentacao->id_card = $card->id_card;
            $newMovimentacao->id_status = $card->id_status;
            $newMovimentacao->dt_registro = \Carbon\Carbon::now();
            $newMovimentacao->save();
        }
        } catch (\Throwable $th) {
           dd($td);
        }
       


        return Redirect()->back()->with('success','Atualizado com sucesso');

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
