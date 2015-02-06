@extends('layouts/layout')

@section('content')

    <div class="jumbotron">

        @if(Actividad::CuantosJuegan() >= 16)
            <h5>Juegan {{ Actividad::CuantosJuegan() }}, o sea, hay partidazo !!!</h5>
        @endif
            @if(Actividad::CuantosJuegan() >= 12 && Actividad::CuantosJuegan() < 16)
                <h5>Juegan {{ Actividad::CuantosJuegan() }}, o sea, hay partido pero hay que correr.</h5>
            @elseif(Actividad::CuantosJuegan()> 0 && Actividad::CuantosJuegan() < 12)
                <h5>¡¡¡Con {{ Actividad::CuantosJuegan() }} inscriptos para el fútbol no armamos partido todavía!!! </h5>
            @else
                <h5>¡¡¡Maricas, nadie juega todavía!!!</h5>
            @endif

            @if (Actividad::CuantosComen() == 0)
                <h5>Nadie tiene hambre todavía.</h5>
            @else
                <h5>Comen {{ Actividad::CuantosComen() }}, hacen falta {{ (Actividad::CuantosComen()*0.5) }} kilos de
                    carne, {{ (Actividad::CuantosComen()*0.125)}} kilos de pan y ensalada a gusto.</h5>
            @endif

    </div>


    <table class="table table-striped table-hover">

        @if (Actividad::CuantosComen() > 0 || Actividad::CuantosJuegan()> 0)
            <thead>
            <th>Foto</th>
            <th>Jugador</th>
            <th>Fecha inscripción</th>
            <th>Actividad</th>
            </thead>
        @endif
        <tbody>
        @foreach ($actividades as $actividad)

            <tr>
                <td><img class="img-circle" src="{{$actividad->photo }}" alt="Profile image"></td>
                <td>{{ $actividad->name }}</td>
                <td>{{ date("d/m/Y H:i:s",strtotime ($actividad->updated_at)) }}</td>
                @if ($actividad->actividad == 'comeyjuega')
                    <td><i class="fa fa-futbol-o"></i>   &nbsp;  <i class="fa fa-cutlery"></i></td>
                @elseif ($actividad->actividad == 'come')
                    <td><i class="fa fa-cutlery"></i></td>
                @else
                    <td><i class="fa fa-futbol-o"></i></td>
                @endif

            </tr>

        @endforeach
        </tbody>
    </table>
@stop