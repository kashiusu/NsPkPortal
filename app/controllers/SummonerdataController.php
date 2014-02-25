<?php

class SummonerdataController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    
       
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
}