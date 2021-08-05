
@extends('layouts.app')

@section('content')  
    <div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">Cadastro de novo curso</div>
            <div class="panel-body">
                <form method="post" action="{{route('post.create.curso')}}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nome do Curso</label>
                        <input type="text" class="form-control" name="curso" id="curso" placeholder="Nome do Curso">
                    </div>
                    <button type="submit" class="btn btn-warning">Cadastrar</button>
                </form>
            </div>
        </div>
    </div>
@endsection