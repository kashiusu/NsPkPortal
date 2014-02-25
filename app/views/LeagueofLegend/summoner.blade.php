@extends('LeagueofLegend/layouts/lollayout')

@section('content')
<br/>

<?php 
    $info = Summoner::find($id);
    echo '<h2>' . $info->name . '</h1>';
    $data = SummonerdataController::showSumonnerData($id);
    foreach($data as $value){
        $ratio = SummonerdataController::calculWinrate($id, $value->leag_type);
        echo '<p>';
        echo $value->leag_name;
        echo ' : <br/>' . $value->tier . ' ' . $value->rank;
        echo '<br/>';
        echo 'LP : '.$value->lp . '<br/>';
        echo 'wins : ' . $value->wins . ' ' . 'losses : '.$value->losses . '<br/>';
        echo $ratio . ' % winrate';
        echo '</p>';
    }
?>

@stop