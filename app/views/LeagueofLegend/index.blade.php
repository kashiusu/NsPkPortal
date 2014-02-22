@extends('LeagueofLegend/layouts/lollayout')

@section('content')
<br/>
<span style='color: red'>{{Session::get('renew_message')}}</span>
    @foreach($Summoners as $Sum)
        
    <p> {{$Sum->name}}<br/>
        </p>
        <p>
            {{Form::open(array('url' => URL::route('renew'))) }}
            {{Form::hidden('id', $Sum->id) }}
            {{Form::submit('Renew data')}}
            {{ Form::close()}}           
        </p>
    @endforeach
@stop