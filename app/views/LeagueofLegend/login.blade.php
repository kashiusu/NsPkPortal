@extends('LeagueofLegend/layouts/lollayout')

@section('content')

@if (Session::has('login_errors'))
        <span class="error">error</span>
@endif 
                
<p>{{Form::open(array('url' => 'LeagueofLegend/login')) }}
    {{Form::label('Username');}} <br/>
    {{Form::text('user', Input::old('user'));}}<br/><br/>
    {{Form::label('Password');}}<br/>
    {{Form::password('password');}}<br/>
    {{Form::submit('Login');}}
    {{Form::close() }}</p>
    
@stop