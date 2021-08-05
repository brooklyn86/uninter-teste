
@extends('layouts.app')

@section('content')  
    <div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">Listagem de Professir</div>
            <div class="panel-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($professores as $professor)
                        <tr>
                            <th scope="row">{{$professor->id_professor}}</th>
                            <td>{{$professor->nome}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection