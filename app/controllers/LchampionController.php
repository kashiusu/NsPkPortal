<?php

class LchampionController extends BaseController {
    
    public static function Refresh()
    {
        $Champions = LchampionController::getUrl();
        
        foreach ($Champions['data'] as $value){
            $lchamp = LeagueChampion::firstOrNew(array(
                'id'    => $value['key'],
                'name'  => $value['name'],
                'w'     => $value['image']['w'],
                'h'     => $value['image']['h'],
                'y'     => $value['image']['y'],
                'x'     => $value['image']['x'],
                'sprite'=> $value['image']['sprite']
                    ));

            $lchamp->save();
        }
                
        return Redirect::route('manage_item');
    }
    
    public static function getUrl()
    {
        $url = 'https://prod.api.pvp.net/api/lol/static-data/euw/v1/champion?locale=en_US&champData=image&api_key=ff830f4a-74c0-4329-9a69-ea1128099d0c';
        $response = @json_decode(file_get_contents($url), TRUE);
        
        return $response;
    }  
}