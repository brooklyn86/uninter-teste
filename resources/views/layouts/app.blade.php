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

        <link rel="shortcut icon" href="/assets/imagens/trello-desktop.jpg" type="image/jpg" />
        <link rel="apple-touch-icon" href="/assets/imagens/trello-desktop.jpg" type="image/jpg" />
        <link rel="stylesheet" href="/assets/bootstrap-3.3.7/css/bootstrap.min.css" />
        <link rel="stylesheet" href="/assets/css/kanban.css" />
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    </head>

    <? flush(); ?>

    <body>  

        @include('includes.navbar')
        <main class="py-4">
            @yield('content')
        </main>
        <div id="form-card" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Visualização do Card</h4>
                </div>
                <div class="modal-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Registro</th>
                            <th scope="col">N° Aula</th>
                            <th scope="col">Ano</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row" class="registro"></th>
                            <td class="naula"></td>
                            <td class="ano"></td>
                        </tr>
                    </tbody>
                </table>
                <div class="panel panel-default">
                    <div class="panel-footer">
                        <h6><b>Curso</b></h6>
                        <p class="aula"></p>
                    </div>
                </div>
                <ul class="nav nav-tabs">
                    <li role="presentation" class="dropdown">
                    <a><i class="glyphicon glyphicon-user"></i> Professores</a></li>

                </ul>
                <div class="professores" style="padding:10px;"></div>

                <ul class="nav nav-tabs">
                    <li role="presentation" class="dropdown">
                      <a><i class="glyphicon glyphicon-list-alt"></i> Materiais</a>
                    </li>
                    
                </ul>
                <div class="materiais" style="padding:10px;"></div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default status" data-dismiss="modal"></button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </body>
<script src="/assets/js/jquery-1.11.2.min.js"></script>

<script src="/assets/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="/assets/js/autocomplete.js"></script>
<script src="https://momentjs.com/downloads/moment-with-locales.min.js"></script>

@include('includes.alerts')

<script type="text/javascript">
    $(function()
    {
        $('[data-toggle="tooltip"]').tooltip();
        $('.js-example-basic-single').select2();
        getCardsDemanda();
        getCardsMaterial();
        getCardsConferencia();
        getCardsConferido();


        $('#form-card').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var id_card = button.data('id_card') // Extract info from data-* attributes
            var naula = button.data('naula') // Extract info from data-* attributes
            var ano = button.data('ano') // Extract info from data-* attributes
            var color = button.data('color') // Extract info from data-* attributes
            var status = button.data('status') // Extract info from data-* attributes
            var id_status = button.data('id_status') // Extract info from data-* attributes
            var tipo = button.data('tipo') // Extract info from data-* attributes
            var curso = button.data('curso') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('.modal-title').text('Visualização do Card #'+id_card)
            modal.find('.naula').html('<span class="label label-primary">'+naula+'</span>')
            modal.find('.ano').html('<span class="label label-success">'+ano+'</span>')
            modal.find('.status').removeClass('btn-info')
            modal.find('.status').removeClass('btn-default')
            if(tipo == 2){
                modal.find('.aula').html('Aulão');
                modal.find('.aula').addClass('aulaoModal');

            }else{
                modal.find('.aula').html('<i class="glyphicon glyphicon-education"></i> '+curso);

            }

            axios.get('/filter-card/'+id_status+'?id_card='+id_card)
            .then(function (response) {
                var professor_content = '';
                var material_content = '';

                
                response.data.cards.map((item) => {
                    professor_content += '<div class="wrapper-professores">';
                    item.professores.map((item) => {
                        professor_content +=  '<span class="label"  style="margin-right: 10px">'+item.nome+'</span>';
                    })

                    professor_content +=  '</div>';
                    item.materiais.map((item) => {
                        material_content += '<span class="badge badge-secondary" style="margin-right: 10px"><span class="glyphicon '+item.icone+'" data-toggle="tooltip" data-placement="top" title="'+item.material+'" style="margin-right: 6px"></span>'+item.material+'</span>';
                    })

                    
                    modal.find('.registro').html('<i class="glyphicon glyphicon-calendar"></i> '+moment(item.dt_registro).locale('pt_br').format('DD/MM/YYYY hh:mm:ss'));

                });
                modal.find('.professores').html(professor_content);
                modal.find('.materiais').html(material_content);

            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })

            modal.find('.status').addClass('btn-'+color)
            modal.find('.status').html(status)
            modal.find('.modal-body input').val('')
        })

        $('#select-filtro-curso').on('change', function() {
            getCardsDemanda();
            getCardsMaterial();
            getCardsConferencia();
            getCardsConferido();
        });
        $('#select-filtro-num-aula').on('change', function() {
            getCardsDemanda();
            getCardsMaterial();
            getCardsConferencia();
            getCardsConferido();
        });
        // $('#input-filtro-professor').on('change', function() {
        //     getCardsDemanda();
        //     getCardsMaterial();
        //     getCardsConferencia();
        //     getCardsConferido();
        // });
        $('#select-filtro-ordenar-por').on('change', function() {
            getCardsDemanda();
            getCardsMaterial();
            getCardsConferencia();
            getCardsConferido();
        });
        $('#select-filtro-ordenar').on('change', function() {
            getCardsDemanda();
            getCardsMaterial();
            getCardsConferencia();
            getCardsConferido();
        });


    $('#input-filtro-professor').autocomplete({
        serviceUrl: '/autocomplete/professor',
        showNoSuggestionNotice:true,
        noSuggestionNotice: 'Nenhum professor encontrado',
        onSelect: function (suggestion, query) {
           
            $('#input-filtro-professor-value').val(suggestion.data);
            getCardsDemanda();
            getCardsMaterial();
            getCardsConferencia();
            getCardsConferido();
        },
        onSearchStart: function (suggestion,query) {
            if(suggestion.query.length == 1){
                $('#input-filtro-professor-value').val('');
                getCardsDemanda();
                getCardsMaterial();
                getCardsConferencia();
                getCardsConferido();
            }
        }
    });
    });

    function getCardsDemanda(){
        var curso = $('#select-filtro-curso').val();
        var nAula = $('#select-filtro-num-aula').val();
        var professor = $('#input-filtro-professor-value').val();
        var ordernar = $('#select-filtro-ordenar-por').val();
        var ordem = $('#select-filtro-ordenar').val();
        axios.get('/filter-card/1?curso='+curso+'&nAula='+nAula+'&professor='+professor+'&ordernar='+ordernar+'&ordem='+ordem)
        .then(function (response) {
            var demanda_content = '';
            response.data.cards.map((item) => {
                if(item.id_tipo == 2){
                    demanda_content += '<div class="panel panel-default card aulao">';

                }else{
                    demanda_content += '<div class="panel panel-default card">';

                }
                demanda_content +='<div class="panel-body">'+

                '<div class="row">'+
                '<div class="col-xs-9">';
                if(item.id_tipo == 2){
                    demanda_content +=  '<h5>Aulão </h5>';

                }else{
                    demanda_content += '<h5>'+item.curso+'</h5>';

                }
                demanda_content += '<div class="wrapper-professores">';
                item.professores.map((item) => {
                    demanda_content +=  '<span class="label">'+item.nome+'</span>';
                })

                demanda_content +=  '</div>'+
                '</div>'+
                '<div class="col-xs-3 text-right">'+
                '<span class="label label-primary label-num-aula">A'+item.num_aula+'</span>'+
                '<span class="label label-success label-ano">'+item.ano+'</span>'+
                '</div>'+
                '</div>'+

                '</div>'+
                '<div class="panel-footer">';
                item.materiais.map((item) => {
                    demanda_content += '<span class="glyphicon '+item.icone+'" data-toggle="tooltip" data-placement="top" title="'+item.material+'" style="margin-right: 6px"></span>';
                })

            
                demanda_content += '<div class="dropdown pull-right">'+
                '<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">'+
                '<span class="glyphicon glyphicon-move"></span>'+
                'Mover <span class="caret"></span>'+
                '</a>'+
                '<ul class="dropdown-menu">'+
                '<li class="dropdown-header">Ações</li>'+
                '<li role="separator" class="divider"></li>'+
                '<li><a href="/teste/'+item.id_card+'/next">&raquo; Prosseguir</a></li>'+
                '</ul>'+
                '</div>'+

                '<a href="#" class="pull-right" data-toggle="modal" data-target="#form-card" data-id_card="'+item.id_card+'" data-id_status="'+item.id_status+'"  data-curso="'+item.curso+'" data-tipo="'+item.id_tipo+'" data-naula="A'+item.num_aula+'" data-ano="'+item.ano+'" data-color="'+item.cor+'"  data-status="'+item.status+'" style="margin-right: 10px">'+
                '<span class="glyphicon glyphicon-eye-open"></span> Visualizar'+
                '</a>'+

                '</div>'+
                '</div>'
            });
            $('#cards-demanda').html(demanda_content);
            $('#demandaContador').html(response.data.quantidade);

        })
        .catch(function (error) {
            // handle error
            console.log(error);
        })
    }

    function getCardsMaterial(){
        var curso = $('#select-filtro-curso').val();
        var nAula = $('#select-filtro-num-aula').val();
        var professor = $('#input-filtro-professor-value').val();
        var ordernar = $('#select-filtro-ordenar-por').val();
        var ordem = $('#select-filtro-ordenar').val();
        axios.get('/filter-card/2?curso='+curso+'&nAula='+nAula+'&professor='+professor+'&ordernar='+ordernar+'&ordem='+ordem)
        .then(function (response) {
            var demanda_content = '';
            response.data.cards.map((item) => {
                if(item.id_tipo == 2){
                    demanda_content += '<div class="panel panel-default card aulao">';

                }else{
                    demanda_content += '<div class="panel panel-default card">';

                }
                demanda_content +='<div class="panel-body">'+

                '<div class="row">'+
                '<div class="col-xs-9">';
                if(item.id_tipo == 2){
                    demanda_content +=  '<h5>Aulão </h5>';

                }else{
                    demanda_content += '<h5>'+item.curso+'</h5>';

                }
                demanda_content += '<div class="wrapper-professores">';
                item.professores.map((item) => {
                    demanda_content +=  '<span class="label">'+item.nome+'</span>';
                })

                demanda_content +=  '</div>'+
                '</div>'+
                '<div class="col-xs-3 text-right">'+
                '<span class="label label-primary label-num-aula">A'+item.num_aula+'</span>'+
                '<span class="label label-success label-ano">'+item.ano+'</span>'+
                '</div>'+
                '</div>'+

                '</div>'+
                '<div class="panel-footer">';
                item.materiais.map((item) => {
                    demanda_content += '<span class="glyphicon '+item.icone+'" data-toggle="tooltip" data-placement="top" title="'+item.material+'" style="margin-right: 6px"></span>';
                })

            
                demanda_content += '<div class="dropdown pull-right">'+
                '<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">'+
                '<span class="glyphicon glyphicon-move"></span>'+
                'Mover <span class="caret"></span>'+
                '</a>'+
                '<ul class="dropdown-menu">'+
                '<li class="dropdown-header">Ações</li>'+
                '<li role="separator" class="divider"></li>'+
                '<li><a href="/teste/'+item.id_card+'/next">&raquo; Prosseguir</a></li>'+
                '<li role="separator" class="divider"></li>'+
                '<li><a href="/teste/'+item.id_card+'/back">&laquo; Voltar</a></li>'+

                '</ul>'+
                '</div>'+

                
                '<a href="#" class="pull-right" data-toggle="modal" data-target="#form-card" data-id_card="'+item.id_card+'" data-id_status="'+item.id_status+'"  data-curso="'+item.curso+'" data-tipo="'+item.id_tipo+'" data-naula="A'+item.num_aula+'" data-ano="'+item.ano+'" data-color="'+item.cor+'"  data-status="'+item.status+'" style="margin-right: 10px">'+


                '<span class="glyphicon glyphicon-eye-open"></span> Visualizar'+
                            '</a>'+

                            '</div>'+
                            '</div>'
            });
            $('#cards-material-recebido').html(demanda_content);
            $('#materialContador').html(response.data.quantidade);

        })
        .catch(function (error) {
            // handle error
            console.log(error);
        })
    }
    function getCardsConferencia(){ 
        var curso = $('#select-filtro-curso').val();
        var nAula = $('#select-filtro-num-aula').val();
        var professor = $('#input-filtro-professor-value').val();
        var ordernar = $('#select-filtro-ordenar-por').val();
        var ordem = $('#select-filtro-ordenar').val();
        axios.get('/filter-card/3?curso='+curso+'&nAula='+nAula+'&professor='+professor+'&ordernar='+ordernar+'&ordem='+ordem)

        .then(function (response) {
            var demanda_content = '';
            response.data.cards.map((item) => {
                if(item.id_tipo == 2){
                    demanda_content += '<div class="panel panel-default card aulao">';

                }else{
                    demanda_content += '<div class="panel panel-default card">';

                }
                demanda_content +='<div class="panel-body">'+

                '<div class="row">'+
                '<div class="col-xs-9">';
                if(item.id_tipo == 2){
                    demanda_content +=  '<h5>Aulão </h5>';

                }else{
                    demanda_content += '<h5>'+item.curso+'</h5>';

                }
                demanda_content += '<div class="wrapper-professores">';
                item.professores.map((item) => {
                    demanda_content +=  '<span class="label">'+item.nome+'</span>';
                })

                demanda_content +=  '</div>'+
                '</div>'+
                '<div class="col-xs-3 text-right">'+
                '<span class="label label-primary label-num-aula">A'+item.num_aula+'</span>'+
                '<span class="label label-success label-ano">'+item.ano+'</span>'+
                '</div>'+
                '</div>'+

                '</div>'+
                '<div class="panel-footer">';
                item.materiais.map((item) => {
                    demanda_content += '<span class="glyphicon '+item.icone+'" data-toggle="tooltip" data-placement="top" title="'+item.material+'" style="margin-right: 6px"></span>';
                })

            
                demanda_content += '<div class="dropdown pull-right">'+
                '<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">'+
                '<span class="glyphicon glyphicon-move"></span>'+
                'Mover <span class="caret"></span>'+
                '</a>'+
                '<ul class="dropdown-menu">'+
                '<li class="dropdown-header">Ações</li>'+
                '<li role="separator" class="divider"></li>'+
                '<li><a href="/teste/'+item.id_card+'/next">&raquo; Prosseguir</a></li>'+
                '<li role="separator" class="divider"></li>'+
                '<li><a href="/teste/'+item.id_card+'/back">&laquo; Voltar</a></li>'+
                '</ul>'+
                '</div>'+

                
                                '<a href="#" class="pull-right" data-toggle="modal" data-target="#form-card" data-id_card="'+item.id_card+'" data-id_status="'+item.id_status+'"  data-curso="'+item.curso+'" data-tipo="'+item.id_tipo+'" data-naula="A'+item.num_aula+'" data-ano="'+item.ano+'" data-color="'+item.cor+'"  data-status="'+item.status+'" style="margin-right: 10px">'+


                '<span class="glyphicon glyphicon-eye-open"></span> Visualizar'+
                            '</a>'+

                            '</div>'+
                            '</div>'
            });
            $('#cards-em-conferencia').html(demanda_content);
            $('#conferenciaContador').html(response.data.quantidade);

        })
        .catch(function (error) {
            // handle error
            console.log(error);
        })
    }
    function getCardsConferido(){
        var curso = $('#select-filtro-curso').val();
        var nAula = $('#select-filtro-num-aula').val();
        var professor = $('#input-filtro-professor-value').val();
        var ordernar = $('#select-filtro-ordenar-por').val();
        var ordem = $('#select-filtro-ordenar').val();
        axios.get('/filter-card/4?curso='+curso+'&nAula='+nAula+'&professor='+professor+'&ordernar='+ordernar+'&ordem='+ordem)
        .then(function (response) {
            var demanda_content = '';
            response.data.cards.map((item) => {
                
                if(item.id_tipo == 2){
                    demanda_content += '<div class="panel panel-default card aulao">';

                }else{
                    demanda_content += '<div class="panel panel-default card">';

                }
                demanda_content +='<div class="panel-body">'+

                '<div class="row">'+
                '<div class="col-xs-9">';
                if(item.id_tipo == 2){
                    demanda_content +=  '<h5>Aulão </h5>';

                }else{
                    demanda_content += '<h5>'+item.curso+'</h5>';

                }
                demanda_content += '<div class="wrapper-professores">';
                item.professores.map((item) => {
                    demanda_content +=  '<span class="label">'+item.nome+'</span>';
                })

                demanda_content +=  '</div>'+
                '</div>'+
                '<div class="col-xs-3 text-right">'+
                '<span class="label label-primary label-num-aula">A'+item.num_aula+'</span>'+
                '<span class="label label-success label-ano">'+item.ano+'</span>'+
                '</div>'+
                '</div>'+

                '</div>'+
                '<div class="panel-footer">';
                item.materiais.map((item) => {
                    demanda_content += '<span class="glyphicon '+item.icone+'" data-toggle="tooltip" data-placement="top" title="'+item.material+'" style="margin-right: 6px"></span>';
                })

            
                demanda_content += '<div class="dropdown pull-right">'+
                '<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">'+
                '<span class="glyphicon glyphicon-move"></span>'+
                'Mover <span class="caret"></span>'+
                '</a>'+
                '<ul class="dropdown-menu">'+
                '<li class="dropdown-header">Ações</li>'+
                '<li role="separator" class="divider"></li>'+
                '<li><a href="/teste/'+item.id_card+'/back">&laquo; Voltar</a></li>'+
                '</ul>'+
                '</div>'+

                
                                '<a href="#" class="pull-right" data-toggle="modal" data-target="#form-card" data-id_card="'+item.id_card+'" data-id_status="'+item.id_status+'"  data-curso="'+item.curso+'" data-tipo="'+item.id_tipo+'" data-naula="A'+item.num_aula+'" data-ano="'+item.ano+'" data-color="'+item.cor+'"  data-status="'+item.status+'" style="margin-right: 10px">'+


                '<span class="glyphicon glyphicon-eye-open"></span> Visualizar'+
                            '</a>'+

                            '</div>'+
                            '</div>'

                });

            $('#cards-conferido').html(demanda_content);
            $('#conferidolContador').html(response.data.quantidade);

        })
        .catch(function (error) {
            // handle error
            console.log(error);
        })
    }
</script>
</html>
