@extends('layout')

@section('content')

<?php
    $id = 19668345;
    $Summonerleaguestat = SummonerController::showLeagueStat($id);
            foreach ($Summonerleaguestat['playerStatSummaries'] as $Value){
                $leaguetype = SummonerController::selectType($Value['playerStatSummaryType']);
                if ($leaguetype != 0){
                    
                    $updateLeague = League::where('summoners_id', $id)->where('leaguetypes_id', $leaguetype);
                    $updateLeague->update(array(
                        'wins' => $Value['wins'],
                        'losses' => $Value['losses']
                    ));
                            
                }
            }
    
?>
@stop