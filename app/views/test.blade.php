@extends('layout')

@section('content')

<?php
    $kashiu = 19668345;
    $id = 35537088;
    $leag = 1;
    $season = 'SEASON4';
    /**
     * echo '<pre>';
     * echo '</pre>';
     * 
     */
    $champions = Championdata::where('summoners_id', $kashiu)->where('leaguechampions_id', '>', 0)->get();
    foreach($champions as $test){
        //echo '<pre>';
        //echo $test->leaguechampions_id;
        //echo ' '. $test->totalSessionsPlayed;
        //echo '</pre>';
    }
    
    echo '<p>--------------------</p>';
    
$temps = SummonerdataController::showtimes($id);

$testdate = SummonerdataController::formatdatediff($temps['d1'], $temps['d2']);



echo 'last update : '.$testdate . ' ago';
?>
{{Session::get('message')}}
{{Form::open(array('url' => URL::route('renew'))) }}
    {{Form::hidden('id', $id)}}
    {{Form::submit('test')}}
{{ Form::close()}}   
@stop