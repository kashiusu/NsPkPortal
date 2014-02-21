@extends('LeagueofLegend/layouts/lollayout')

@section('content')
<h5>Ajouter un Summoner</h5>


@foreach($errors->all() as $message)
    <p style="color: red; font-weight: bold">{{$message}}</p>

@endforeach

    {{ Form::open(array('url' => 'LeagueofLegend/add')) }}
    {{Form::hidden('id', Input::old('id'))}}
    {{Form::label('name','Summoner Name')}} : {{Form::text('name', Input::old('name'))}} {{Form::submit('Ajouter')}}
    
    {{ Form::close() }}

@stop