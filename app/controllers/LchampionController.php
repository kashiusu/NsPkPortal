<?php

class LchampionController extends BaseController {
    
    public static function Refresh()
    {
        $Champions = LchampionController::getUrl();
        
        foreach ($Champions['data'] as $data){
            $lchamp = LeagueChampion::firstOrNew(array(
                'id'    => $data['key'],
                'name'  => $data['name'],
                'group' => $data['image']['group'],
                'image' => $data['image']['full']
                    ));

            $lchamp->save();
        }
                
        return Redirect::route('manage_item');
    }
    
    public static function getUrl()
    {
        $url = 'https://prod.api.pvp.net/api/lol/static-data/euw/v1/champion?locale=en_US&champData=all&api_key=ff830f4a-74c0-4329-9a69-ea1128099d0c';
        $response = @json_decode(file_get_contents($url), TRUE);
        
        return $response;
    }  
}