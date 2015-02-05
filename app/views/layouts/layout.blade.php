<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Fútbol y asado con amigos">
    <meta name="author" content="Martin Revert">

    <title>Futbol y asado con amigos</title>

    <!--	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet"> -->

    <link href="http://bootswatch.com/cyborg/bootstrap.min.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">


    <style type="text/css">
        body {
            padding: 20px;
        }

        .navbar {
            margin-bottom: 30px;
        }

        @font-face {
            font-family: MiFont;
            font-feature-settings: "dlig";
            src: url("fonts/MEgalopolisExtra.otf") format("opentype");
        }

    </style>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.6.2/html5shiv.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.2.0/respond.js"></script>
    <![endif]-->
</head>

<body>

<div class="container-fluid">


    <!-- Static navbar -->
    <div class="navbar navbar-default">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" style="font-family: MiFont" href="http://www.futbolyasado.com"><i
                        class="fa fa-home"></i>Futbol y Asado</a>
        </div>

        @if(Auth::check())
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li>

                        <a href="{{url('/actividad')}}"><i class="fa fa-users"></i>¿Quiénes van?</a>
                    </li>

                    <li>
                        <a href="{{url('/compras')}}"><i class="fa fa-cart-plus"></i> ¿Quién compra?</a>
                    </li>

                </ul>
                <ul class="nav navbar-nav navbar-right">


                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false"><i class="fa fa-user"></i> {{{ $data['name'] }}}<span
                                    class="caret"></span></a>

                        <ul class="dropdown-menu">
                            <li>
                                <a href="#">Mi perfil</a>
                            </li>
                            <li>
                                <a href="{{url('logout')}}">Salir</a>
                            </li>
                        </ul>
                    </li>
                    <li><img class="media-object" src="{{ $data['photo']}}" alt="Profile image">
                    </li>

                </ul>
            </div><!--.nav-collapse-->
        @endif

    </div>
    <!--/.nav-default -->

    @if(Session::has('message'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                &times;
            </button>
            {{ Session::get('message')}}
        </div>
        @endif

                <!-- Main component for a primary marketing message or call to action -->
        <div class="row">
            <div class="col-md-6">
                <h6>{{ \Carbon\Carbon::now()->diffForHumans(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', Maindate::getMainDate()->fecha)) }}
                    the next match!</h6>
                <h6>Próximo partido el dia {{ date("l d/m/Y H:i",strtotime (Maindate::getMainDate()->fecha)) }}hs</h6>
            </div>
            <div class="col-md-3">
                <p>El tiempo hoy</p>
            </div>
            <div class="col-md-3">
                <p>Pronóstico {{ date("d/m/Y",strtotime (Maindate::getMainDate()->fecha)) }}</p>
            </div>
        </div>
        <div class="row">

            @yield('content')

        </div><!-- /row -->
</div>
<!-- /container -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<script src="/js/weather.js"></script>

</body>
</html>