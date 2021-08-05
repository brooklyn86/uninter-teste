
@extends('layouts.app')

@section('content')  
    <div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">Cadastro de novo material ao card #{{$card->id_card}}</div>
            <div class="panel-body">
                <form method="post" action="{{route('post.create.material.card')}}">
                    @csrf
                    <div class="form-group">
                        <label for="id_material">Escolha um material</label>
                        <select class="form-control js-example-basic-single" name="id_material" id="id_material">
                            <option value="">Escolha um material</option>

                            @foreach($materiais as $material)
                                <option value="{{$material->id_material}}">{{$material->material}}</option>
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