@extends('LeagueofLegend/layouts/lollayout')

@section('content')
<br/>

    @foreach($Summoners as $Sum)
        
    <p> <a href="LeagueofLegend/summoner/{{$Sum->id}}">{{$Sum->name}}</a><br/>
        <?php 
        $data = SummonerdataController::showSumonnerDataSolo($Sum->id);
        foreach ($data as $value){
            echo $value->tier . ' ' . $value->rank;
        }
    ?> 
        </p>

    @endforeach
@stop