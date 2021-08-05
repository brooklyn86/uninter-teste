
@extends('layouts.app')

@section('content')  
    <div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">Cadastro de novo professor ao card #{{$card->id_card}}</div>
            <div class="panel-body">
                <form method="post" action="{{route('post.create.professor.card')}}">
                    @csrf
                    <div class="form-group">
                        <label for="id_professor">Escolha um Professor</label>
                        <select class="form-control js-example-basic-single" name="id_professor" id="id_professor">
                            <option value="">Escolha um material</option>

                            @foreach($professores as $professor)
                                <option value="{{$professor->id_professor}}">{{$professor->nome}}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="id_card" value="{{$card->id_card}}" />
                    </div>
                    <button type="submit" class="btn btn-warning">Cadastrar</button>
                </form>
            </div>
        </div>
    </div>
@endsection