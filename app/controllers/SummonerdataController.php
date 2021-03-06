<?php

class SummonerdataController extends BaseController {


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
       
	public static function showSumonnerData($id)
        {
            $Summoners = Summonerdata::where('sum_id', $id)->orderBy('leag_type')->get();
            return $Summoners;
        }
        
        public static function showSumonnerDataSolo($id)
        {
            $Summoner = Summonerdata::whereRaw('sum_id ='. $id .' and leag_type = "RANKED_SOLO_5x5"')->get();
            return $Summoner;
        }
        
        public static function deleteSummonerData($id){
            
            DB::table('leagues')->where('summoners_id', '=', $id)->delete();
        }
        
        public static function calculWinrate($id, $leag){
            $ratio = 0;
            $Summoner = Summonerdata::whereRaw('sum_id ='. $id .' and leag_type = "'. $leag.'"')->get();
            foreach($Summoner as $value){
                if (($value['wins']+$value['losses']) > 0){
                    $ratio = round(($value['wins'] / ($value['wins'] + $value['losses'])) * 100, 1);
                }   
            }
            return $ratio;
        }
        
        public static function updateDataStat($id)
        {
            $Summonerleaguestat = self::showLeagueStat($id);
            foreach ($Summonerleaguestat['playerStatSummaries'] as $Value){
                $leaguetype = self::selectType($Value['playerStatSummaryType']);
                if ($leaguetype != 'Other'){
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
                        return 'RANKED_SOLO_5x5';
                    case 'RANKED_TEAM_3x3':
                        return 'RANKED_TEAM_3x3';
                    case 'RANKED_TEAM_5x5':
                        return 'RANKED_TEAM_5x5';
                    case 'RankedSolo5x5':
                        return 'RANKED_SOLO_5x5';
                    case 'RankedTeam3x3':
                        return 'RANKED_TEAM_3x3';
                    case 'RankedTeam5x5':
                        return 'RANKED_TEAM_5x5';
                    default :
                        return 'Other';
                }            
	}
        public static function formatdatediff($d1, $d2){
            
            $interval = $d2->diff($d1);
            $doPlural = function($nb,$str){return $nb>1?$str.'s':$str;};

            $format = array();
            
            if($interval->y !== 0) { 
                $format[] = "%y ".$doPlural($interval->y, "year"); 
            } 
            if($interval->m !== 0) { 
                $format[] = "%m ".$doPlural($interval->m, "month"); 
            } 
            if($interval->d !== 0) { 
                $format[] = "%d ".$doPlural($interval->d, "day"); 
            } 
            if($interval->h !== 0) { 
                $format[] = "%h ".$doPlural($interval->h, "hour"); 
            } 
            if($interval->i !== 0) { 
                $format[] = "%i ".$doPlural($interval->i, "minute"); 
            } 
            if($interval->s !== 0) { 
                if(!count($format)) { 
                    return "less than a minute"; 
                } /**else { 
                    $format[] = "%s ".$doPlural($interval->s, "second"); 
                } */
            } 

            if(count($format) > 1) { 
                $format = array_shift($format)." and ".array_shift($format); 
            } else { 
                $format = array_pop($format); 
            } 

            return $interval->format($format); 
        }
        
        public static function showtimes($id){
            $data = League::where('summoners_id', $id)->take(1)->get();
            foreach ($data as $time){
                $d1 = new DateTime($time->updated_at);
                $d2 = new DateTime(date('Y-m-d H:i:s'));
            }
            $result = array('d1'=>$d1, 'd2'=>$d2);
            return $result;
        }


        public static function renewDataPost(){
            $id = Input::get('id');
            $name = SummonerController::getName($id);
            $a = self::showtimes($id);
            $b = $a['d1']->diff($a['d2'])->format('%y%m%d%h%i');
            if ($b > 20){
                SummonerController::update($id);
                return Redirect::back()->with('message', $name.' data has been updated.');
            }
            return Redirect::back()->with('message', '<span style="color: red">It was recently updated. You can refresh data again shortly</span>');
        }
}