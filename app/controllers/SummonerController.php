<?php

class SummonerController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    
       	public static function test()
	{
            return View::make('test');
	}
        /**
         * Affiche la liste des Summoners + stats dans la view
         * 
         */
        public static function showSummonerAll()
        {
           $summoners =  DB::table('summoners')
                        ->join('leagues', function($join)
                        {
                            $join->on('summoners.id', '=', 'leagues.summoners_id')
                                 ->where('leagues.leaguetypes_id', '=', 1);
                        })
                        ->get();
            return $summoners;
        }
        
        public static function showSummoner($id)
        {
           $summoner =  DB::table('summoners')
                        ->where('id', '=', $id)
                        ->join('leagues', function($join)
                        {
                            $join->on('summoners.id', '=', 'leagues.summoners_id')
                                 ->where('leagues.leaguetypes_id', '=', 1);
                        })
                        ->get();
            return $summoner;            
        }
        
        /**
         * Envoie l'url avec l'id d'un Summoner
         * pour récuperer les leagues
         * @param type $id
         * @return array
         * 
         */
        public static function showLeague($id)
        {
            $url='https://prod.api.pvp.net/api/lol/euw/v2.3/league/by-summoner/'.$id.'/entry?api_key=ff830f4a-74c0-4329-9a69-ea1128099d0c';
            $response = @json_decode(file_get_contents($url), true);
           
            return $response;
            
        }
        /**
         * Envoie l'url avec l'id d'un Summoner
         * pour récuperer les stats de leagues
         * !! ATTENTION SEASON might be VARIABLE !!
         * @param type $id
         * @return array
         * 
         */
        public static function showLeagueStat($id)
        {
            $url='https://prod.api.pvp.net/api/lol/euw/v1.2/stats/by-summoner/'.$id.'/summary?season=SEASON4&api_key=ff830f4a-74c0-4329-9a69-ea1128099d0c';
            $response = @json_decode(file_get_contents($url), true);
           
            return $response;
            
        }
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
               
	public static function addPost()
	{
            $name = Input::get('name');    
            
            $rules1 = array('name'  =>  'required');   
            $rules2 = array('id' => 'required|unique:summoners,id'); 
            $vname = array ('name' => $name); 
            $message1 = array (
                    'unique:summoners,id' => "This Summoner already exist");
            $v = Validator::make($vname, $rules1,$message1);
            
            if($v->fails())
            {
                return Redirect::to('LeagueofLegend/manage_s')->withErrors($v)->withInput(); 
            }else{
                
                $nospace = str_replace(" ", "", $name);
                $id = SummonerController::getId(trim($nospace));
                
                $vid = array('id' => $id);
                $message2 = array(
                    'required' => "This Summoner doesn't exist",
                );
                $v2 = Validator::make($vid, $rules2, $message2);
                
                if($v2->fails())
                {
                    return Redirect::back()->withErrors($v2)->withInput(); 
                }else{
                    DB::insert('insert into summoners (id, name) values ('.$id.', "'.$name.'")');
                    SummonerController::update($id);
                    //return Redirect::to('LeagueofLegend/manage_s');
                    return Redirect::back()->with('add_message', $name . ' have been added');
                }
            }
        
	}
        
        public static function getName($id)
        {
            $Summoner = SummonerController::showLeague($id);
            if (count($Summoner) != 0){
                
                foreach ($Summoner as $value){
                    if(!strcmp($value['playerOrTeamId'], $id)){
                         return $value['playerOrTeamName'];
                    }
                }
            }else{
                $name = '';
                return $name;
            }
             
        }
        
        public static function getId($name)
        {
            $url = 'https://prod.api.pvp.net/api/lol/euw/v1.3/summoner/by-name/'. $name .'?api_key=ff830f4a-74c0-4329-9a69-ea1128099d0c';
            $response = @json_decode(file_get_contents($url), TRUE);
            
            if(count($response) !=0){
                foreach ($response as $value){
                    return $value['id'];
                }   
            }  else {
                $id ='';
                return $id;
            }
            
        }
        
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
        
        public static function update($id){
            SummonerController::updateData($id);
            SummonerController::updateDataStat($id);
            //return Redirect::back();
        }


        public static function updateData($id)
        {
            $Summonerleague = SummonerController::showLeague($id);
            foreach ($Summonerleague as $SumL){
                $leaguetype = SummonerController::selectType($SumL['queueType']);
                
                League::firstOrCreate(array(
                        'summoners_id'  => $id,
                        'leaguetypes_id'=> $leaguetype
                        ));
               $updateLeagueData = League::where('summoners_id', $id)->where('leaguetypes_id', $leaguetype);
               $updateLeagueData->update(array(
                        'leaguename'    => $SumL['leagueName'],
                        'tier'          => $SumL['tier'],
                        'rank'          => $SumL['rank'],
                        'lp'            => $SumL['leaguePoints'],
                    ));
            }
        }
        
        
        public static function updateDataStat($id)
        {
            $Summonerleaguestat = SummonerController::showLeagueStat($id);
            foreach ($Summonerleaguestat['playerStatSummaries'] as $Value){
                $leaguetype = SummonerController::selectType($Value['playerStatSummaryType']);
                if ($leaguetype != 0){
                    $updateLeagueStat = League::where('summoners_id', $id)->where('leaguetypes_id', $leaguetype);
                    $updateLeagueStat->update(array(
                        'wins' => $Value['wins'],
                        'losses' => $Value['losses']
                    ));
                }
            }
        }
        
	public static function selectType($type)
	{
            switch ($type){
                    case 'RANKED_SOLO_5x5':
                        return 1;
                    case 'RANKED_TEAM_3x3':
                        return 2;
                    case 'RANKED_TEAM_5x5':
                        return 3;
                    case 'RankedSolo5x5':
                        return 1;
                    case 'RankedTeam3x3':
                        return 2;
                    case 'RankedTeam5x5':
                        return 3;
                    default :
                        return 0;
                }            
	}
        
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function deletePost()
        {
            $id = Input::get('id');
            $summoner = Summoner::find($id);
            $name = SummonerController::getName($id);
            if(!empty($summoner)){
                DB::table('summoners')->where('id', '=', $id)->delete();
                return Redirect::to('LeagueofLegend/manage_s')->with('delete_message', $name . ' has been deleted');
            }
        }

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function preUrl($id)
	{
        return View::make('summoners.edit');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
