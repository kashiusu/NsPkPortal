@extends('LeagueofLegend/layouts/lollayout')

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
    
    function getChampionName($champId){
        $Champ = LeagueChampion::where('id', $champId)->get();
        foreach ($Champ as $info){
            $name = $info->name;
        }
        return $name;
    }
    
    function calculWinrate($win,$total){
        $winrate = 0;
        if ($total > 0){
            $winrate = round(($win/$total)*100,1);
        }
        return $winrate;
    }
    function calculeAverage($value,$total){
        $average = 0;
        if ($total > 0){
            $average = round(($value/$total),1);
        }   
        return $average;
    }
  ?>
<div id="boulet">test image</div>
<div id="test">
<table class="tablesorter">
 <thead> 
  <tr>
    <th>Champion</th>
    <th>Played</th>
    <th>Win %</th>
    <th>Kill</th>
    <th>Death</th>
    <th>Assist</th>
    <th>CS</th>
    <th>Gold</th>
  </tr>
 </thead> 
<tbody> 

<?php
    $champions = Championdata::where('summoners_id', $kashiu)->where('leaguechampions_id', '>', 0)->orderby('leaguechampions_id')->get();
    foreach($champions as $test){
        //echo '<pre>';
        //echo $test->leaguechampions_id;
        //echo ' '. $test->totalSessionsPlayed;
        //echo '</pre>';
        echo '<tr>';
        echo '<td>'. getChampionName($test->leaguechampions_id) . '</td>';
        echo '<td class="contenu">'. $test->totalSessionsPlayed . '</td>';
        echo '<td class="contenu">'. calculWinrate($test->totalSessionsWon, $test->totalSessionsPlayed) . '%</td>';
        echo '<td class="contenu">'. calculeAverage($test->totalChampionKills, $test->totalSessionsPlayed) . '</td>';
        echo '<td class="contenu">'. calculeAverage($test->totalDeathsPerSession, $test->totalSessionsPlayed) . '</td>';
        echo '<td class="contenu">'. calculeAverage($test->totalAssists, $test->totalSessionsPlayed) . '</td>';
        echo '<td class="contenu">'. calculeAverage($test->totalMinionKills, $test->totalSessionsPlayed) . '</td>';
        echo '<td class="contenu">'. calculeAverage($test->totalGoldEarned, $test->totalSessionsPlayed) . '</td>';
        echo '</tr>';
    }
 ?>
</tbody> 
</table>
</div>


@stop