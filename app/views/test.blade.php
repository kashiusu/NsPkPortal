@extends('LeagueofLegend/layouts/lollayout')

@section('content')
<!--
[image] => Array
                        (
                            [full] => SummonerBoost.png
                            [sprite] => spell0.png
                            [group] => spell
                            [x] => 96
                            [y] => 0
                            [w] => 48
                            [h] => 48
                        )
-->
<?php
    $kashiu = 19668345;
    
    $url = 'https://prod.api.pvp.net/api/lol/euw/v1.2/stats/by-summoner/'.$kashiu.'/ranked?season=SEASON4&api_key=ff830f4a-74c0-4329-9a69-ea1128099d0c';
    $response = @json_decode(file_get_contents($url), true);
    
    echo '<pre>';
    print_r($response);

    echo '</pre>';
?>

@stop