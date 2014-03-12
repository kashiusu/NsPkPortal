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
    $url='https://prod.api.pvp.net/api/lol/euw/v1.3/game/by-summoner/'.$kashiu.'/recent?api_key=ff830f4a-74c0-4329-9a69-ea1128099d0c';
    $response = @json_decode(file_get_contents($url), true);
 ?>
<!--
    Information a garder :
    -gameId (id de la game pour la Db?)
    -subType (type de game)
    -teamId (your team id)
    -championId (your champion)
    -spell1
    -spell2
    -[fellowPlayers]
        -summonerId
        -teamId
        -championId
    -[stats]
        -goldEarned
        -numDeaths
        -minionsKilled
        -championsKilled
        -win
        -largestMultiKill
        -totalDamageDealtToChampions
        -timePlayed
        -assists
        -item0
        -item1
        -item2
        -item3
        -item4
        -item5
        -item6
        -----------------------

    foreach($response as $value){
        foreach($value['0'] as $infos){
            echo $infos['gameId'] . '<br/>';
            foreach ($infos['fellowPlayers'] as $summoner){
                echo 'summoner ' . $i;
                echo $summoner['summonerId'];
                $i++;
            }
            foreach ($infos['stats'] as $stats){
                echo $stats['goldEarned'];
            }
        }
    }

-->
<p><pre>
{{$url}}
<br/>

<?php 

    foreach($response['games'] as $data){
        
        $i = 0;
        $kills = 0;
        $assists = 0;
        $result = 'red';
        if(isset($data['stats']['championsKilled'])){
            $kills = $data['stats']['championsKilled'];
        }
        
        if(isset($data['stats']['assists'])){
            $assists = $data['stats']['assists'];
        }
        
        $doPlural = function($nb,$str){return $nb>1?$str.'s':$str;};
        $format = array();
        
        $date = new DateTime();
        $date->setTimestamp($data['stats']['timePlayed']);
        $time = $date->format('H:i:s');
        
        echo '<p>';
        echo $data['gameId'] . ' : '. $data['subType'] . '<br>';
        echo $data['gameType']. ' : ' .$data['gameMode'].'<br>';
        echo 'time played: '. $time.'<br>';
        echo 'Champion :'. $data['championId'].'<br>';
        echo 'spell 1: '. $data['spell1'].'| Spell 2: '. $data['spell2'].'<br>';
        
        $j = 0;
        echo 'items : ';
        while($j <= 6){
            if(isset($data['stats']['item'.$j])){
                echo $data['stats']['item'.$j]. ', ';
            }
            $j++;
        }
        echo '<br>';
        echo 'gold : '. $data['stats']['goldEarned'].'<br>';
        
        echo 'Kill : '. $kills. ' Death : '. $data['stats']['numDeaths'].' Assist : '. $assists.'<br>';
        echo 'cs : '. $data['stats']['minionsKilled'].'<br>';
        
        if(isset($data['fellowPlayers'])){
            foreach($data['fellowPlayers'] as $players){
                echo 'Summoner' . $i. ': '. $players['summonerId'] . ' Champion:'.$players['championId'].' Team:'.$players['teamId']. ' ';
                $i++;
            }
        }  else {
            echo 'No other summoners.';
        }
        echo '<br>';
      
        if ($data['stats']['win']){
            $result = 'green';
        }
        echo $result;
        echo '</p>';
    }
?>
</pre>
</p>

@stop