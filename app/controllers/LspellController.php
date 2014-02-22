<?php

class LspellController extends BaseController {
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public static function Refresh()
	{
            $Spells = LspellController::getUrl();

            foreach ($Spells['data'] as $spell){
                $lspell = Leaguespell::firstOrNew(array(
                    'id'    => $spell['id'],
                    'name'  => $spell['name'],
                    'description'     => $spell['description']
                        ));

                $lspell->save();
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
            $url = 'https://prod.api.pvp.net/api/lol/static-data/euw/v1/summoner-spell?locale=en_US&api_key=ff830f4a-74c0-4329-9a69-ea1128099d0c';
            $response = @json_decode(file_get_contents($url), TRUE);

            return $response;
	}
}
