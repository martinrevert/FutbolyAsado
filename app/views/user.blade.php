@extends('layouts/layout')

@section('content')

    @if (!empty($data))

       @if (!Actividad::Check($uid, Maindate::getMainDate()->fecha))
        <div class="jumbotron">
            <h3>{{ \Carbon\Carbon::now()->diffForHumans(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', Maindate::getMainDate()->fecha)) }}
                the match</h3>
            <br>

            <p class="text-center">
                <a class="btn btn-lg btn-primary btn-block" href="{{url('action/comeyjuega')}}">Juego y como
                    (machazo)</a>
            </p>

            <br>

            <p class="text-center">
                <a class="btn btn-lg btn-primary btn-block" href="{{url('action/come')}}">Como solamente (conchita)</a>
            </p>
            <br>

            <p class="text-center">
                <a class="btn btn-lg btn-primary btn-block" href="{{url('action/juega')}}">Juego solamente (rarito)</a>
            </p>
        </div>
           @else
           <div class="jumbotron">
           <h5>Ya estás registrado para el evento.</h5>
           </div>
           @endif
    @else
        <div class="jumbotron">
            <h1></h1>

            <p class="text-center">
                <a class="btn btn-lg btn-primary" href="{{url('login/fb')}}"><i class="fa fa-facebook"></i> Login con
                    Facebook</a>
            </p>
    @endif

@stop