@extends('layouts/layout')

@section('content')


    <div class="jumbotron">
        <h4>Partido del dia {{ date("l d/m/Y",strtotime ($fecha->fecha)) }}:</h4>
        <hr>
        @if(Actividad::CuantosJuegan() >= 16)
            <h5>Juegan {{ Actividad::CuantosJuegan() }}, o sea, hay partidazo !!!</h5>
            @if(Actividad::CuantosJuegan() >= 14 && Actividad::CuantosJuegan() < 16)
                <h5>Juegan {{ Actividad::CuantosJuegan() }}, o sea, hay partido pero hay que correr.</h5>
            @elseif(Actividad::CuantosJuegan()> 0 && Actividad::CuantosJuegan() < 14)
                <h5>¡¡¡Con {{ Actividad::CuantosJuegan() }} no armamos partido todavía!!! </h5>
            @else
                <h5>¡¡¡Maricas, nadie juega todavía!!!</h5>
            @endif

            @if (Actividad::CuantosComen() == 0)
                <h5>Nadie tiene hambre todavía.</h5>
            @else
                <h5>Comen {{ Actividad::CuantosComen() }}, hacen falta {{ (Actividad::CuantosComen()*0.5) }} kilos de
                    carne, {{ (Actividad::CuantosComen()*0.200)}} kilos de pan y ensalada a gusto.</h5>
            @endif
    </div>

    <table class="table table-striped table-hover">
        <tbody>
        <thead>
        <th>Foto</th>
        <th>Jugador</th>
        <th>Fecha inscripción</th>
        <th>Actividad</th>
        </thead>
        @foreach ($actividades as $actividad)

            <tr>
                <td><img class="media-object" src="{{$actividad->photo }}" alt="Profile image"></td>
                <td>{{ $actividad->name }}</td>
                <td>{{ $actividad->updated_at }}</td>
                <td>{{ $actividad->actividad }}</td>
            </tr>

            @endforeach

            </tbody>


@stop