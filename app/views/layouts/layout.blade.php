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

        h6 {
            text-align: center;
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
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script src="js/weather.js"></script>
    <script src="js/datedropper.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/datedropper.css">
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
            <a class="navbar-brand" style="font-family: MiFont;font-size:150%;color:blue;"
               href="http://www.futbolyasado.com"><i
                        class="fa fa-home"></i>Fútbol y Asado</a>
        </div>

        @if(Auth::check())
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li>

                        <a href="{{url('/actividad')}}" style="font-size: 150%"><i class="fa fa-users"></i>¿Quiénes van?</a>
                    </li>

                    <li>
                        <a href="{{url('/compras')}}" style="font-size: 150%"><i class="fa fa-cart-plus"></i> ¿Quién
                            compra?</a>
                    </li>
                    @if($data['name'] == 'Martin Revert')
                        <li><a href="{{url('/admin')}}" style="font-size: 150%"><i class="fa fa-wrench"></i>
                                Administrador</a></li>
                    @endif

                </ul>
                <ul class="nav navbar-nav navbar-right">


                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false" style="font-size: 150%"><i
                                    class="fa fa-user"></i> {{{ $data['name'] }}}<span
                                    class="caret"></span></a>

                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{url('perfil')}}" style="font-size: 150%">Mi perfil</a>
                            </li>
                            <li>
                                <a href="{{url('logout')}}" style="font-size: 150%">Salir</a>
                            </li>
                        </ul>
                    </li>
                    <li><img style="" src="{{ $data['photo']}}" alt="Profile image">
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
                <h4>{{ \Carbon\Carbon::now()->diffForHumans(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', Maindate::getMainDate()->fecha)) }}
                    the next match!</h4>
                <h4>Próximo partido el dia {{ date("l d/m/Y H:i",strtotime (Maindate::getMainDate()->fecha)) }}hs</h4>
            </div>
            <div class="col-md-3">
                <h6>El tiempo ahora</h6>

                <p id="weathernow" class="text-center"></p>

                <p id="condicion" class="text-center"></p>

                <p id="temp" class="text-center"></p>

                <p id="feelslike" class="text-center"></p>

                <p id="humidity" class="text-center"></p>

                <p id="windir" class="text-center"></p>

                <p id="windvel" class="text-center"></p>

                <p id="rain" class="text-center"></p>

                <p id="cloudcover" class="text-center"></p>
            </div>

            @if((strval(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', Maindate::getMainDate()->fecha)->diffInDays())) <= 4 )
                <div class="col-md-3">
                    <h6>Pronóstico noche {{ date("d/m/Y",strtotime (Maindate::getMainDate()->fecha)) }}</h6>

                    <p id="weathernow-forecast" class="text-center"></p>

                    <p id="condicion-forecast" class="text-center"></p>

                    <p id="temp-forecast" class="text-center"></p>

                    <p id="humidity-forecast" class="text-center"></p>

                    <p id="chanceofrain" class="text-center"></p>

                    <p id="chanceoffog" class="text-center"></p>

                    <p id="chanceofwindy" class="text-center"></p>

                    <p id="chanceofhightemp" class="text-center"></p>

                    <p id="chanceoffrost" class="text-center"></p>
                </div>
            @endif
        </div>
        <div class="row">

            @yield('content')

        </div>  <!-- /row -->
</div>
<!-- /container -->

<script>$("#maindate").dateDropper({format:"Y-m-d"});</script>

</body>
</html>