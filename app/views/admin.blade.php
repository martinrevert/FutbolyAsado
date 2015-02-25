@extends('layouts/layout')

@section('content')


    <div class="jumbotron">
        {{ Form::open(array('url' => 'fecha')) }}
        <div class="input-group">
            <!--     <input type="text" class="form-control" id="maindate" aria-describedby="basic-addon2"> -->

            {{ Form::text ('maindate', null, array('id'=>'maindate')); }} {{ Form::submit('Enviar', ['class'=>'btn btn-default']); }}
        </div>
        {{ Form::close() }}
    </div>
@stop