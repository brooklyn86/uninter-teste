
@extends('layouts.app')

@section('content')  
    <div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">Cadastro de novo professor</div>
            <div class="panel-body">
                <form method="post" action="{{route('post.create.professor')}}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nome do Professor</label>
                        <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome do Professor">
                    </div>
                    <button type="submit" class="btn btn-warning">Cadastrar</button>
                </form>
            </div>
        </div>
    </div>
@endsection