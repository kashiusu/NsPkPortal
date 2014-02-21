<?php

class UserController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function loginPost()
        {
           $user = array(
               'name' => Input::get('user'),
               'password' => Input::get('password')
           );
           
           if(Auth::attempt($user)){
               return Redirect::to('LeagueofLegend/');
           }else{
               return Redirect::to('LeagueofLegend/login')->with('login_errors', true);
           }

        }
        
        public function registerPost()
        {
            $user = Input::get('user');
            $email = Input::get('email');
            $pwd = Input::get('password');
            $cpwd = Input::get('cpassword');
            $role = 1;
            
            $hashpwd = Hash::make($pwd);
            
            if($pwd != $cpwd)
            {
			return Redirect::to('LeagueofLegend/register')
			->with('register_errors', true);
            }else{
                $values = array(
                    'email' => $email,
                    'name' => $user,
                    'password' => $pwd,
                    'permission_id' => $role);
                                
                $rules = array(
		'name' 	=> 'unique:users,name|required|min:1|max:20',
		'password' 	=> 'required|min:8',
		'email' 	=> 'unique:users,email|required');
                
                $v = Validator::make($values, $rules);
             
                if ( $v->fails() )
		{
			// redirect back to the form with
			// errors, input and our currently
			// logged in user
			return Redirect::to('LeagueofLegend/register')
			->with('user', Auth::user())
			->withErrors($v)
			->withInput();
		}
                $values['password'] = $hashpwd;
		$users = new User();
		$users->fill($values);
		$result = $users->save();
		// call Auth::attempt() on the username and password    
		// to try to login, the session will be created
		// automatically on success
                
                $log = array(
                    'name' => $user,
                    'password' => $pwd
                );

		if($result)
		{
			if(Auth::attempt($log))
			{
				// it worked, redirect to the admin route
				return Redirect::to('LeagueofLegend/');
			}
			else
			{
				// login failed, show the form again and
				// use the login_errors data to show that
				// an error occured
				return Redirect::to('LeagueofLegend/login')
				->with('login_errors', true);
			}
		}
		else
		{
			return Redirect::to('LeagueofLegend/register')
			->with('register_errors', true);
		}
            }
        }
        
        public function logout()
        {
            Auth::logout();
            return Redirect::to('LeagueofLegend/');
        }
}