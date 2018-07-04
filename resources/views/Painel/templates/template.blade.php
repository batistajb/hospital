     <!DOCTYPE html>
<html lang="pt-br">
      <head>
        <title>{{$title or 'Sistema AEC-Hospital '}}</title>     
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>
        <link rel="stylesheet" href="{{url('assets/Painel/CSS/style.css')}}">        
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
         @yield('style')
      </head>
    <body>

        <nav class="navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>                        
                    </button>
                    <a class="navbar-brand" href="#">Hospital</a>
                </div>
                @if(Auth::user())
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="{{route('dashboard')}}">Início</a></li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Cadastrar<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{route('paciente.index')}}">Paciente</a></li>
                                <li><a href="{{route('especialidade.index')}}">Especialidade</a></li>
                                <li><a href="{{route('medico.index')}}">Médico</a></li>
                                <li><a href="{{route('exame.index')}}">Exame</a></li>
                                <li><a href="{{route('tecnico.index')}}">Técnico</a></li>
                                 @if(Auth::user()->acesso == 0)
                                <li><a href="{{route('usuario.index')}}">Usuário</a></li>
                                 @endif
                                <li><a href="{{route('feedback.index')}}">Feedback Paciente</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Agendar<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{route('agendarexame.index')}}">Exame</a></li>
                                <li><a href="{{route('agendarconsulta.index')}}">Consulta</a></li>
                            </ul>
                        </li>
                        @if(Auth::user()->acesso == 0)
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Relatorios<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{route('relatorioexame.index')}}">Exame</a></li>
                                    <li><a href="{{route('relatorioconsulta.index')}}">Consulta</a></li>
                                    <li><a href="{{route('relatoriofeedback.store')}}">FeedBack Paciente</a></li>

                                </ul>
                            </li>
                        @endif
                    </ul>
                    @endif
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('Entrar') }}</a></li>
                             @if(Auth::user())
                            <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li><a  href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();"> {{'Sair'}} </a></li>                                       
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </ul>
                                
                            </li>
                        @endguest
                    </ul>
                    
                    
<!--                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="{{route('logout')}}"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                        <li><a href="{{ route('login') }}"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                    </ul>-->
                </div>
            </div>
        </nav>
        
        
        <div class="container">
            @yield('conteudo')
      
        </div>
         @yield('script')
    </body>
</html>
