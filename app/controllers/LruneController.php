<?php

class LruneController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public static function Refresh()
	{
            $Runes = LruneController::getUrl();

            foreach ($Runes['data'] as $key => $rune){
                $lrune = Leaguerune::firstOrNew(array(
                    'id'    => $key,
                    'name'  => $rune['name'],
                    'description'     => $rune['description']
                        ));

                $lrune->save();
            }

            return Redirect::route('manage_item');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public static function getUrl()
	{
            $url = 'https://prod.api.pvp.net/api/lol/static-data/euw/v1/rune?locale=en_US&runeListData=basic&api_key=ff830f4a-74c0-4329-9a69-ea1128099d0c';
            $response = @json_decode(file_get_contents($url), TRUE);

            return $response;
	}
}
