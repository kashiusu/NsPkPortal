@extends('layout')

@section('content')

<?php
    $kashiu = 19668345;
    
    $sumall = Summoner::all();

?>

@foreach($sumall as $Sum)

 
<p> {{$Sum->name}} <br/>
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