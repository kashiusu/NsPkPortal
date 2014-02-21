@extends('LeagueofLegend/layouts/lollayout')

@section('content')
<!--
    Gestion des champions de League of legend
-->
    <?php 
        $Champion = LchampionController::getUrl();
        $Lchampion = Leaguechampion::all();
        $x = 0;
        foreach ($Champion['data'] as $Champ){
            ++$x;
        }
        
        if($x == count($Lchampion)){
            $etat = 'updated';
        }else{
            $etat = 'outdated';
        }?>
        
    <p>List of champions is {{$etat}} </p>               
       
    {{Form::open(array('url' => URL::route('RefreshChamp')))}}
    {{Form::submit('Refresh')}}
    {{Form::close()}}
    
 <!--
    Gestion des items de League of Legend
 -->
 
       <?php 
        $Items = LitemController::getUrl();
        $Litems = Leagueitem::all();
        $y = 0;
        foreach ($Items['data'] as $iteml){
            ++$y;
        }
        
        if($y == count($Litems)){
            $etat = 'updated';
        }else{
            $etat = 'outdated';
        }?>
        
    <p>List of items is {{$etat}} </p>               
       
    {{Form::open(array('url' => URL::route('RefreshItem')))}}
    {{Form::submit('Refresh')}}
    {{Form::close()}}
<!--    
    Gestion des runes de League of Legend
-->
    <?php 
        $Runes = LruneController::getUrl();
        $Lrunes = Leaguerune::all();
        $z = 0;
        foreach ($Runes['data'] as $runel){
            ++$z;
        }
        
        if($z == count($Lrunes)){
            $etat = 'updated';
        }else{
            $etat = 'outdated';
        }?>
        
    <p>List of runes is {{$etat}} </p>               
       
    {{Form::open(array('url' => URL::route('RefreshRune')))}}
    {{Form::submit('Refresh')}}
    {{Form::close()}}
<!--
    Gestion des spells de League of Legend
-->
    <?php 
        $Spells = LspellController::getUrl();
        $Lspells = Leaguespell::all();
        $w = 0;
        foreach ($Spells['data'] as $spelll){
            ++$w;
        }
        
        if($w == count($Lspells)){
            $etat = 'updated';
        }else{
            $etat = 'outdated';
        }?>
        
    <p>List of spells is {{$etat}} </p>               
       
    {{Form::open(array('url' => URL::route('RefreshSpell')))}}
    {{Form::submit('Refresh')}}
    {{Form::close()}} 
<!--
    Gestion des masteries de League of Legend
-->
    <?php 
        $Masteries = LmasterieController::getUrl();
        $Lmasteries = Leaguemasterie::all();
        $q = 0;
        foreach ($Masteries['data'] as $masteriel){
            ++$q;
        }
        
        if($q == count($Lmasteries)){
            $etat = 'updated';
        }else{
            $etat = 'outdated';
        }?>
        
    <p>List of masteries is {{$etat}} </p>               
       
    {{Form::open(array('url' => URL::route('RefreshMastery')))}}
    {{Form::submit('Refresh')}}
    {{Form::close()}} 
@stop