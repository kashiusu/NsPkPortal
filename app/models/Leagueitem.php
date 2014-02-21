<?php

class Leagueitem extends Eloquent {
    
    protected $table = 'leagueitems';
    
    protected $fillable = array('id', 'name', 'w', 'h', 'x', 'y', 'sprite');
}
