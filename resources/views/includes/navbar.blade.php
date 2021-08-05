<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><img src="/assets/imagens/logo-uninter.png" width="50%"/></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
         @if (Route::has('login'))
              
              @auth
                  <li><a href="{{ url('/') }}">Home</a></li>
              @else
              <li><a href="{{ route('login') }}">Login</a></li>
              @if (Route::has('register'))
                  <li><a href="{{ route('register') }}">Cadastro</a></li>
              @endif
              @endauth

          @endif
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Card<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="{{ route('lista.cards') }}">Listagem de cards</a></li>
            <li><a href="{{ route('cadastro.card') }}">Cadastrar novo cards</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Professor<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="{{ route('lista.professores') }}">Listagem de Professores</a></li>
            <li><a href="{{ route('professor.cadastro') }}">Cadastrar novo Professor</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cursos<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="{{ route('lista.cursos') }}">Listagem de cursos</a></li>
            <li><a href="{{ route('curso.cadastro') }}">Cadastrar novo curso</a></li>
          </ul>
        </li>
        @auth
          <li><a href="{{ route('logout') }}">Sair</a></li>
        @endauth
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>