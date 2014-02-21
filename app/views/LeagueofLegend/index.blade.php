@extends('LeagueofLegend/layouts/lollayout')

@section('content')

    
    @foreach($Summoners as $Sum)
    <p> {{$Sum->name}} <br/>
        </p>
        <p>
            {{ Form::open(array('url' => 'LeagueofLegend/renew')) }}
                {{Form::hidden('id', $Sum->id) }}
                {{Form::submit('Renew Data');}}
            {{ Form::close() }}            
        </p>
    @endforeach
@stop