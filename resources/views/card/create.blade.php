
@extends('layouts.app')

@section('content')  
    <div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">Cadastro de novo Card de conteúdo</div>
            <div class="panel-body">
                <form method="post" action="{{route('post.create.card')}}">
                    @csrf
                    <div class="form-group">
                        <label for="id_curso">Escolha um curso</label>
                        <select class="form-control js-example-basic-single" name="id_curso" id="id_curso">
                            <option value="">Escolha um curso</option>

                            @foreach($cursos as $curso)
                                <option value="{{$curso->id_curso}}">{{$curso->curso}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_curso">Escolha um tipo</label>
                        <select class="form-control js-example-basic-single" name="id_tipo" id="id_tipo">
                            <option value="">Escolha um tipo</option>

                            @foreach($types as $type)
                                <option value="{{$type->id_tipo}}">{{$type->tipo}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="name">Quantidade de Aulas</label>
                        <input type="number" class="form-control" name="num_aula" id="num_aula" placeholder="Quantidade de Aulas">
                    </div>
                    <button type="submit" class="btn btn-warning">Cadastrar</button>
                </form>
            </div>
        </div>
    </div>
@endsection