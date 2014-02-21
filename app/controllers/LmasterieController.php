<?php

class LmasterieController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public static function Refresh()
	{
            $Masteries = LmasterieController::getUrl();

            foreach ($Masteries['data'] as $masterie){
                $lmasterie = Leaguemasterie::firstOrNew(array(
                    'id'    => $masterie['id'],
                    'name'  => $masterie['name']
                        ));

                $lmasterie->save();
            }

            return Redirect::route('manage');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public static function getUrl()
	{
            $url = 'https://prod.api.pvp.net/api/lol/static-data/euw/v1/mastery?locale=en_US&api_key=ff830f4a-74c0-4329-9a69-ea1128099d0chttps://prod.api.pvp.net/api/lol/static-data/euw/v1/rune?locale=en_US&runeListData=basic&api_key=ff830f4a-74c0-4329-9a69-ea1128099d0c';
            $response = @json_decode(file_get_contents($url), TRUE);

            return $response;
	}
}

