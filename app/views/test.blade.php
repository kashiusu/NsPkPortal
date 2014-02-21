@extends('layout')

@section('content')

<?php
    $id = 19668345;
    $test = SummonerController::showLeagueStat($id);

    echo '<pre>';
    echo print_r($test);
    echo '</pre>';    
        
?>
@stop