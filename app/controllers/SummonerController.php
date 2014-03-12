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
                                 ->where('leagues.leaguetypes_id', '=', 'RANKED_SOLO_5x5');
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
                                 ->where('leagues.leaguetypes_id', '=', 'RANKED_SOLO_5x5');
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
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
               
	public static function addPost()
	{
            $Inputname = Input::get('name');    
            
            $rules1 = array('name'  =>  'required');   
            $rules2 = array('id' => 'required|unique:summoners,id'); 
            $vname = array ('name' => $Inputname); 
            $message1 = array (
                    'unique:summoners,id' => "This Summoner already exist");
            $v = Validator::make($vname, $rules1,$message1);
            
            if($v->fails())
            {
                return Redirect::to('LeagueofLegend/manage_s')->withErrors($v)->withInput(); 
            }else{
                
                $nospace = str_replace(" ", "", $Inputname);
                $id = self::getId(trim($nospace));
                
                $vid = array('id' => $id);
                $message2 = array(
                    'required' => "This Summoner doesn't exist",
                );
                $v2 = Validator::make($vid, $rules2, $message2);
                
                if($v2->fails())
                {
                    return Redirect::back()->withErrors($v2)->withInput(); 
                }else{
                    $name = self::getName($id);
                    DB::insert('insert into summoners (id, name) values ('.$id.', "'.$name.'")');
                    self::update($id);
                    //return Redirect::to('LeagueofLegend/manage_s');
                    return Redirect::back()->with('add_message', $name . ' have been added');
                }
            }
        
	}
        
        public static function getName($id)
        {
            $Summoner = self::showLeague($id);
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
            self::updateData($id);
            SummonerdataController::updateDataStat($id);
            ChampiondataController::updateChampionData($id);
            //return Redirect::back();
        }


        public static function updateData($id)
        {
            $Summonerleague = self::showLeague($id);
            foreach ($Summonerleague as $SumL){
                //$leaguetype = SummonerdataController::selectType($SumL['queueType']);
                
                League::firstOrCreate(array(
                        'summoners_id'  => $id,
                        'leaguetypes_id'=> $SumL['queueType']
                        ));
               $updateLeagueData = League::where('summoners_id', $id)->where('leaguetypes_id', $SumL['queueType']);
               $updateLeagueData->update(array(
                        'leaguename'    => $SumL['leagueName'],
                        'tier'          => $SumL['tier'],
                        'rank'          => $SumL['rank'],
                        'lp'            => $SumL['leaguePoints'],
                    ));
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
            $name = self::getName($id);
            if(!empty($summoner)){
                DB::table('summoners')->where('id', '=', $id)->delete();
                SummonerdataController::deleteSummonerData($id);
                ChampiondataController::deleteChampionData($id);
                return Redirect::to('LeagueofLegend/manage_s')->with('delete_message', $name . ' has been deleted');
            }
        }

}
