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
            $Summoner = Summonerdata::whereRaw('sum_id ='. $id .' and leag_type = 1')->get();
            return $Summoner;
        }
        
        public static function deleteSummonerData($id){
            
            DB::table('leagues')->where('summoners_id', '=', $id)->delete();
        }
        
        public static function calculWinrate($id, $leag){
            $ratio = 0;
            $Summoner = Summonerdata::whereRaw('sum_id ='. $id .' and leag_type = '. $leag)->get();
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
                    return "less than a minute ago"; 
                } else { 
                    $format[] = "%s ".$doPlural($interval->s, "second"); 
                } 
            } 

            if(count($format) > 1) { 
                $format = array_shift($format)." and ".array_shift($format); 
            } else { 
                $format = array_pop($format); 
            } 

            return $interval->format($format); 
        }
}