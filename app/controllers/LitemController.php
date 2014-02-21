<?php

class LitemController extends BaseController {
    
    public static function Refresh()
    {
        $Objets = LitemController::getUrl();
        
        foreach ($Objets['data'] as $value){
            $litem = Leagueitem::firstOrNew(array(
                'id'    => str_replace('.png','',$value['image']['full']),
                'name'  => $value['name'],
                'w'     => $value['image']['w'],
                'h'     => $value['image']['h'],
                'y'     => $value['image']['y'],
                'x'     => $value['image']['x'],
                'sprite'=> $value['image']['sprite']
                    ));

            $litem->save();
        }
                
        return Redirect::route('manage');
    }
    
    public static function getUrl()
    {
        $url = 'https://prod.api.pvp.net/api/lol/static-data/euw/v1/item?locale=en_US&itemListData=image&api_key=ff830f4a-74c0-4329-9a69-ea1128099d0c';
        $response = @json_decode(file_get_contents($url), TRUE);
        
        return $response;
    }  
}