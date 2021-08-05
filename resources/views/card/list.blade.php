
@extends('layouts.app')

@section('content')  
    <div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">Listagem de cursos</div>
            <div class="panel-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Curso</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Professores</th>
                            <th scope="col">Materiais</th>
                            <th scope="col">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cards as $card)
                            <tr>
                                <th scope="row">{{$card->id_card}}</th>
                                <td>{{$card->curso}}</td>
                                <td>{{$card->tipo}}</td>
                                <td>@foreach($card->professores as $professor)
                                    {{$professor->nome}},
                                    @endforeach
                                </td>
                                <td>@foreach($card->materiais as $material)
                                        <span class="glyphicon {{$material->icone}}" data-toggle="tooltip" data-placement="top" title="{{$material->material}}" style="margin-right: 6px"></span>
                                    @endforeach
                                </td>
                                <td>
                                    <a href="/dashboard/cadastro/card/{{$card->id_card}}/material" class="btn btn-info">Adicionar Materia</a>
                                    <a href="/dashboard/cadastro/card/{{$card->id_card}}/professor" class="btn btn-warning">Adicionar Professor</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$cards->links()}}
                
            </div>
        </div>
    </div>
@endsection