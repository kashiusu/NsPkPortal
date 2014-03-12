<?php

class LitemController extends BaseController {
    
    public static function Refresh()
    {
        $Objets = LitemController::getUrl();
        foreach ($Objets['data'] as $data){
            $id = str_replace('.png','',$data['image']['full']);
            $litem = Leagueitem::firstOrNew(array(
                'id'    => $id,
                'name'  => $data['name'],
                'group' => $data['image']['group'],
                'image' => $data['image']['full']
                    ));

            $litem->save();
        }
                
        return Redirect::route('manage_item');
    }
    
    public static function getUrl()
    {
        $url = 'https://prod.api.pvp.net/api/lol/static-data/euw/v1/item?locale=en_US&itemListData=all&api_key=ff830f4a-74c0-4329-9a69-ea1128099d0c';
        $response = @json_decode(file_get_contents($url), TRUE);
        
        return $response;
    }  
}