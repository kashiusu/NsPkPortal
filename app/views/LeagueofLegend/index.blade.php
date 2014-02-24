@extends('LeagueofLegend/layouts/lollayout')

@section('content')
<br/>
<span style='color: red'>{{Session::get('renew_message')}}</span>
    @foreach($Summoners as $Sum)
        
    <p> <a href="LeagueofLegend/summoner/{{$Sum->id}}">{{$Sum->name}}</a><br/>
        <?php 
        $data = SummonerdataController::showSumonnerDataSolo($Sum->id);
        foreach ($data as $value){
            echo $value->tier . ' ' . $value->rank;
        }
    ?> 
        </p>
        <p>
            {{Form::open(array('url' => URL::route('renew'))) }}
            {{Form::hidden('id', $Sum->id) }}
            {{Form::submit('Renew data')}}
            {{ Form::close()}}           
        </p>
    @endforeach
@stop