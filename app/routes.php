<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('test', array(
    'as' => 'fck',
    'uses'=>function(){
        return View::make('test');
    }));

Route::filter('admin', function()
{
    if (Auth::user()->permission_id > 0)
    {
        return Redirect::route('home');
    }
});

Route::pattern('id', '[0-9]+');

//--------------------------------------------------------------------------

Route::get('/', function(){
        return Redirect::to('LeagueofLegend/');
    });
    
Route::get('/login', function(){
        return Redirect::route('login');
    });


Route::get('LeagueofLegend/', array(
    'as' => 'home',
    'uses' => function(){
    $Summoners = Summoner::all();
    return View::make('LeagueofLegend/index')->with('Summoners', $Summoners);
}));


Route::post('LeagueofLegend/renew', array(
        'as' => 'renew',
        'uses' => 'SummonerdataController@renewDataPost'
        ));

Route::get('LeagueofLegend/add', array(
    'as'    => 'add_summoner',
    'before'=> 'auth',
    'uses'  => function(){
    return View::make('LeagueofLegend/add'); }));
Route::post('LeagueofLegend/add', 'SummonerController@addPost');

Route::get('LeagueofLegend/login', function(){
    return View::make('LeagueofLegend/login'); });
Route::post('LeagueofLegend/login', array(
    'as'    => 'login',
    'uses'  => 'UserController@loginPost'));

Route::get('LeagueofLegend/register', function(){
    return View::make('LeagueofLegend/register'); });
Route::post('LeagueofLegend/register', array(
        'as'    => 'register',
        'uses'  => 'UserController@registerPost'));

Route::get('LeagueofLegend/manage_s', array(
    'as'    => 'manage_summoner',
    'before'=> 'auth|admin',
    'uses'  => function(){
            return View::make('LeagueofLegend/manage_s');
            }
    ));
    
 Route::get('LeagueofLegend/manage_i', array(
    'as'    => 'manage_item',
    'before'=> 'auth|admin',
    'uses'  => function(){
            return View::make('LeagueofLegend/manage_i');
            }
    ));
    
Route::post('LeagueofLegend/manage_s/add', array(
    'as'    => 'manage_add',
    'before'=> 'auth|admin',
    'uses'  => 'SummonerController@addPost'));
Route::post('LeagueofLegend/manage_s/delete', array(
    'as'    => 'manage_delete',
    'before'=> 'auth|admin',
    'uses'  => 'SummonerController@deletePost'));
 


Route::get('LeagueofLegend/logout', array(
    'as' => 'logout',
    'before' => 'auth', 
    'uses' => 'UserController@logout'));


Route::post('LeagueofLegend/manage_s/refreshC', array(
    'as'    => 'RefreshChamp',
    'before'=> 'auth|admin',
    'uses'  => 'LchampionController@Refresh'
));

Route::post('LeagueofLegend/manage_s/refreshI', array(
    'as'    => 'RefreshItem',
    'before'=> 'auth|admin',
    'uses'  => 'LitemController@Refresh'
));

Route::post('LeagueofLegend/manage_s/refreshR', array(
    'as'    => 'RefreshRune',
    'before'=> 'auth|admin',
    'uses'  => 'LruneController@Refresh'
));

Route::post('LeagueofLegend/manage_s/refreshS', array(
    'as'    => 'RefreshSpell',
    'before'=> 'auth|admin',
    'uses'  => 'LspellController@Refresh'
));

Route::post('LeagueofLegend/manage_s/refreshM', array(
    'as'    => 'RefreshMastery',
    'before'=> 'auth|admin',
    'uses'  => 'LmasterieController@Refresh'
));

Route::get('LeagueofLegend/summoner/{id}', function($id)
{
    return View::make('LeagueofLegend/summoner')->with('id', $id);
});
