<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt_BR">
    <head>
        <title>KANBAN</title>
        <meta charset="utf-8">
        <meta http-equiv="Expires" content="Mon, 26 Jul 1997 05:00:00 GMT" />
        <meta http-equiv="Last-Modified" content="<?= gmdate('D, d M Y H:i:s') . ' GMT'; ?>" />
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
        <meta http-equiv="Cache-Control" content="post-check=0, pre-check=0" />
        <meta http-equiv="Pragma" content="no-cache" />
        <meta http-equiv="Cache" content="no-cache" />
        <meta http-equiv="imagetoolbar" content="no" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="rating" content="general" />
        <meta name="author" content="Sandro Alves Peres" />
        <meta name="title" content="KANBAN" />
        <meta name="robots" content="noindex,nofollow" />
        <meta name="googlebot" content="noindex,nofollow" />

        <!-- Mobile device meta tags -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=4" />
        <meta name="x-blackberry-defaultHoverEffect" content="false" />
        <meta name="HandheldFriendly" content="true" />
        <meta name="MobileOptimized" content="240" />

        <link rel="shortcut icon" href="./assets/imagens/trello-desktop.jpg" type="image/jpg" />
        <link rel="apple-touch-icon" href="./assets/imagens/trello-desktop.jpg" type="image/jpg" />
        <link rel="stylesheet" href="./assets/bootstrap-3.3.7/css/bootstrap.min.css" />
        <link rel="stylesheet" href="./assets/css/kanban.css" />

    </head>

    <? flush(); ?>

    <body>  

        @include('includes.navbar')

        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="control-label">Curso</label>
                        <select id="select-filtro-curso" class="form-control">
                            @foreach($cursos as $curso)
                                <option value="{{$curso->id_curso}}">{{$curso->curso}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-2 col-md-1">
                    <div class="form-group">
                        <label class="control-label">Nº Aula</label>
                        <select id="select-filtro-num-aula" class="form-control">
                            <option value=""></option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="control-label">Professor</label>
                        <div class="input-group">
                            <input id="input-filtro-professor" type="text" class="form-control" />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-search"></span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="control-label">Ordenar por</label>
                        <select id="select-filtro-ordenar-por" class="form-control">
                            <option value="ano">Ano</option>
                            <option value="curso">Curso</option>
                            <option value="professor">Professor</option>
                            <option value="num-aula">Nº Aula</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="control-label">&nbsp;</label>
                        <select id="select-filtro-ordenar-por" class="form-control">
                            <option value="asc">Crescente</option>
                            <option value="desc">Decrescente</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row card-colunas">
                <div class="col-sm-6 col-md-3">

                    <!-- DEMANDA -->
                    <!-- *************************************************** -->

                    <div class="panel panel-primary coluna">
                        <div class="panel-heading">
                            <p class="panel-title">
                                Demanda
                                <span class="badge badge-num-cards">3</span>
                            </p>
                        </div>
                        <div id="cards-demanda" class="panel-body">

                           

                        </div>
                    </div>

                </div>
                <div class="col-sm-6 col-md-3">

                    <!-- MATERIAL RECEBIDO -->
                    <!-- *************************************************** -->

                    <div class="panel panel-info coluna">
                        <div class="panel-heading">
                            <p class="panel-title">
                                Material Recebido
                                <span class="badge badge-num-cards">3</span>
                            </p>
                        </div>
                        <div id="cards-material-recebido" class="panel-body">

                           

                        </div>
                    </div>

                </div>
                <div class="col-sm-6 col-md-3">

                    <!-- EM CONFERÊNCIA -->
                    <!-- *************************************************** -->

                    <div class="panel panel-danger coluna">
                        <div class="panel-heading">
                            <p class="panel-title">
                                Em Conferência
                                <span class="badge badge-num-cards">3</span>
                            </p>
                        </div>
                        <div id="cards-em-conferencia" class="panel-body">

                           

                        </div>
                    </div>

                </div>
                <div class="col-sm-6 col-md-3">

                    <!-- CONFERIDO -->
                    <!-- *************************************************** -->

                    <div class="panel panel-success coluna">
                        <div class="panel-heading">
                            <p class="panel-title">
                                Conferido
                                <span class="badge badge-num-cards">3</span>
                            </p>
                        </div>
                        <div id="cards-conferido" class="panel-body">

                           

                        </div>
                    </div>

                </div>
            </div>

        </div>

    </body>
    <script src="/assets/js/jquery-1.11.2.min.js"></script>

    <script src="./assets/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(function()
        {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

</html>