@extends('LeagueofLegend/layouts/lollayout')

@section('content')
<br/>
<p>{{Session::get('message')}}</p>
<p>
    <?php
        $temps = SummonerdataController::showtimes($id);
        $testdate = SummonerdataController::formatdatediff($temps['d1'], $temps['d2']);
        echo 'last update : '.$testdate . ' ago';
    ?>
    {{Form::open(array('url' => URL::route('renew'))) }}
        {{Form::hidden('id', $id) }}
        {{Form::submit('Renew data')}}
    {{ Form::close()}}           
    </p>
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
    $champions = Championdata::where('summoners_id', $id)->where('leaguechampions_id', '>', 0)->orderby('totalSessionsPlayed', 'desc')->get();
    foreach($champions as $Champ){
        echo '<tr>';
        echo '<td>'. ChampiondataController::getChampionName($Champ->leaguechampions_id) . '</td>';
        echo '<td class="contenu">'. $Champ->totalSessionsPlayed . '</td>';
        echo '<td class="contenu">'. ChampiondataController::calculWinrate($Champ->totalSessionsWon, $Champ->totalSessionsPlayed) . '%</td>';
        echo '<td class="contenu">'. ChampiondataController::calculeAverage($Champ->totalChampionKills, $Champ->totalSessionsPlayed) . '</td>';
        echo '<td class="contenu">'. ChampiondataController::calculeAverage($Champ->totalDeathsPerSession, $Champ->totalSessionsPlayed) . '</td>';
        echo '<td class="contenu">'. ChampiondataController::calculeAverage($Champ->totalAssists, $Champ->totalSessionsPlayed) . '</td>';
        echo '<td class="contenu">'. ChampiondataController::calculeAverage($Champ->totalMinionKills, $Champ->totalSessionsPlayed) . '</td>';
        echo '<td class="contenu">'. ChampiondataController::calculeAverage($Champ->totalGoldEarned, $Champ->totalSessionsPlayed) . '</td>';
        echo '</tr>';
    }
 ?>
</tbody> 
</table>
</div>

@stop