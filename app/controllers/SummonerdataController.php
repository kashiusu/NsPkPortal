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
}