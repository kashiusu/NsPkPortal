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
    
    echo '<p>--------------------</p>';
    
    $data = League::where('summoners_id', $kashiu)->take(1)->get();
    foreach ($data as $value){
        //echo $value->updated_at;
//        echo '<br/>' . date('Y-m-d H:i:s');
        
    $d1 = new DateTime($value->updated_at);
    $d2 = new DateTime(date('Y-m-d H:i:s'));
             }
            


$testdate = SummonerdataController::formatdatediff($d1, $d2);
echo 'last update : '.$testdate . ' ago';
?>
@stop