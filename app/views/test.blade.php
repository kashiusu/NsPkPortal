@extends('layout')

@section('content')

<?php
    $kashiu = 19668345;
    $leag = 1;
    $season = 'SEASON4';
    /**
     * echo '<pre>';
     * echo '</pre>';
     * 
     */
    $champions = Championdata::where('summoners_id', $kashiu)->where('leaguechampions_id', '>', 0)->get();
    foreach($champions as $test){
        echo '<pre>';
        echo $test->leaguechampions_id;
        echo ' '. $test->totalSessionsPlayed;
        echo '</pre>';
    }
?>
@stop