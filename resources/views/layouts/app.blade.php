<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/x-icon" href="{{ URL('/') }}/favicon.ico"/>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Rizer') }}</title>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="{{ asset('css/AdminLTE.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/datepicker.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/jquery.fancybox.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dataTables.tableTools.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/rizer.css') }}" rel="stylesheet">

</head>

<body class="skin-blue">
    <header class="header">
        <a href="{{ URL('/') }}" class="logo bgpersonalizado">{{ config('app.name', 'Rizer') }}</a>
        <nav class="navbar navbar-static-top bgpersonalizado" role="navigation">
            <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="navbar-right">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="glyphicon glyphicon-user"></i>
                            <span> <i class="caret"></i>
                            </span>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>

                        <ul class="dropdown-menu">
                            <li class="user-footer">
                                <div class="pull-right">
                                    <a href="{{ URL('/') }}/perfil" class="btn btn-default btn-flat">Editar perfil</a>
                                    <a href="{{ route('logout') }}" class="btn btn-default btn-flat" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sair</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <div class="wrapper row-offcanvas row-offcanvas-left">
        <aside class="left-side sidebar-offcanvas">
            <section class="sidebar">
                <ul id="menu" class="sidebar-menu">

                    <li id="principal">
                        <a href="{{ URL('/') }}">
                            <i class="glyphicon glyphicon-list"></i>
                            <span>Principal</span>
                        </a>
                    </li>

                    <li id='users'>
                        <a href="{{ URL('/') }}/users">
                            <i class="glyphicon glyphicon-list"></i>
                            <span>Usuários</span>
                        </a>
                    </li>

                    <li id='profiles'>
                        <a href="{{ URL('/') }}/profiles">
                            <i class="glyphicon glyphicon-list"></i>
                            <span>Perfis de acesso</span>
                        </a>
                    </li>

                    <li id='indicators'>
                        <a href="{{ URL('/') }}/indicators">
                            <i class="glyphicon glyphicon-list"></i>
                            <span>Indicadores</span>
                        </a>
                    </li>

                    <li id='logs'>
                        <a href="{{ URL('/') }}/logs">
                            <i class="glyphicon glyphicon-list"></i>
                            <span>Logs</span>
                        </a>
                    </li>

                    <li id='reports'>
                        <a href="{{ URL('/') }}/reports">
                            <i class="glyphicon glyphicon-list"></i>
                            <span>Relatórios</span>
                        </a>
                    </li>

                </ul>
            </section>
        </aside>

        <aside class="right-side">

            @if(Session::has('flash_success'))
                <div class="pad margin no-print">
                    <div class="alert alert-success" style="margin-bottom: 0!important;">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                        <i class="icon fa fa-check"></i>
                        <b>{{ Session::get('flash_success') }}</b>
                    </div>
                </div>
            @endif

            @if(Session::has('flash_error'))
                <div class="pad margin no-print">
                    <div class="alert alert-danger" style="margin-bottom: 0!important;">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                        <i class="icon fa fa-check"></i>
                        <b>{{ Session::get('flash_error') }}</b>
                    </div>
                </div>
            @endif

            <section class="content">

                @yield('content')

            </section>

        </aside>

    </div>

    <footer class="footer">© 2018 - Todos os direitos reservados</footer>

    <script type="text/javascript" src="{{ asset('js/jquery-2.0.3.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/jquery.maskedinput.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/bootstrap-datepicker.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/tinymce.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/jquery.fancybox.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/jquery.maskMoney.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/chosen.jquery.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/jquery.dataTables.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/jquery.fancybox.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/dataTables.tableTools.min.js') }}"></script>
    
    <script type="text/javascript">
        
        var base = "{{ URL('/') }}";
        var controller = "{{ explode('/', Route::current()->uri)[0] }}";

    </script>
    
    <script src="{{ asset('js/rizer.js') }}"></script>

</body>
</html>
