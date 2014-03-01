<?php

class ChampiondataController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
         * NOTE : leaguechampions_id 0 Correspond au total de tous les stas champions
         * 
	 * @return Response
	 */
          public static function showChampionStat($id, $season)
        {
            $url='https://prod.api.pvp.net/api/lol/euw/v1.2/stats/by-summoner/'.$id.'/ranked?season='.$season.'&api_key=ff830f4a-74c0-4329-9a69-ea1128099d0c';
            $response = @json_decode(file_get_contents($url), true);
           
            return $response;
            
        }
    
         public static function updateChampionData($id)
        {
            $season = 'SEASON4';
            $ChampionStats = self::showChampionStat($id, $season);
            foreach ($ChampionStats['champions'] as $Stat){
                
                Championdata::firstOrCreate(array(
                        'summoners_id'  => $id,
                        'leaguechampions_id'=> $Stat['id']
                        ));
               $updateLeagueData = Championdata::where('summoners_id', $id)->where('leaguechampions_id', $Stat['id']);
               $updateLeagueData->update(array(
                   'totalDeathsPerSession'    => $Stat['stats']['totalDeathsPerSession'],
                   'totalSessionsPlayed'    => $Stat['stats']['totalSessionsPlayed'],
                   'totalDamageTaken'    => $Stat['stats']['totalDamageTaken'],
                   'totalQuadraKills'    => $Stat['stats']['totalQuadraKills'],
                   'totalTripleKills'    => $Stat['stats']['totalTripleKills'],
                   'totalMinionKills'    => $Stat['stats']['totalMinionKills'],
                   'maxChampionsKilled'    => $Stat['stats']['maxChampionsKilled'],
                   'totalDoubleKills'    => $Stat['stats']['totalDoubleKills'],
                   'totalPhysicalDamageDealt'    => $Stat['stats']['totalPhysicalDamageDealt'],
                   'totalChampionKills'    => $Stat['stats']['totalChampionKills'],
                   'totalAssists'    => $Stat['stats']['totalAssists'],
                   'mostChampionKillsPerSession'    => $Stat['stats']['mostChampionKillsPerSession'],
                   'totalDamageDealt'    => $Stat['stats']['totalDamageDealt'],
                   'totalFirstBlood'    => $Stat['stats']['totalFirstBlood'],
                   'totalSessionsLost'    => $Stat['stats']['totalSessionsLost'],
                   'totalSessionsWon'    => $Stat['stats']['totalSessionsWon'],
                   'totalMagicDamageDealt'    => $Stat['stats']['totalMagicDamageDealt'],
                   'totalGoldEarned'    => $Stat['stats']['totalGoldEarned'],
                   'totalPentaKills'    => $Stat['stats']['totalPentaKills'],
                   'totalTurretsKilled'    => $Stat['stats']['totalTurretsKilled'],
                   'mostSpellsCast'    => $Stat['stats']['mostSpellsCast'],
                   'maxNumDeaths'    => $Stat['stats']['maxNumDeaths'],
                   'totalUnrealKills'    => $Stat['stats']['totalUnrealKills'],
                    ));
            }
        }
        
        public static function deleteChampionData($id){
            
            DB::table('championdatas')->where('summoners_id', '=', $id)->delete();
        }
        
        public static function getChampionName($champId){
            $Champ = LeagueChampion::where('id', $champId)->get();
            foreach ($Champ as $info){
                $name = $info->name;
            }
            return $name;
        }
        
        public static function calculWinrate($win,$total){
            $winrate = 0;
            if ($total > 0){
                $winrate = round(($win/$total)*100,1);
            }
            return $winrate;
        }
        
        public static function calculeAverage($value,$total){
            $average = 0;
            if ($total > 0){
                $average = round(($value/$total),1);
            }   
            return $average;
        }
}
