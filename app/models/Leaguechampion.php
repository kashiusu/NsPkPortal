<?php

class LeagueChampion extends Eloquent {
    
    protected $table = 'leaguechampions';
    
    protected $fillable = array('id', 'name', 'w', 'h', 'x', 'y', 'sprite');
}
