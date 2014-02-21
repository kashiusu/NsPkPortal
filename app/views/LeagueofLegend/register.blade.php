@extends('LeagueofLegend/layouts/lollayout')

@section('content')
@foreach($errors->all() as $message)
    <p style="color: red; font-weight: bold">{{$message}}</p>
@endforeach
@if (Session::has('register_errors'))
        <p style="color: red; font-weight: bold">Confirm your password</p>
@endif 
<p>
    {{Form::open(array('url' => 'LeagueofLegend/register')) }}
   {{Form::label('Username')}}<br/>
    {{Form::text('user', Input::old('user'), array('placeholder'=>'Username'));}}<br/>
    {{Form::label('Email')}}<br/>
    {{Form::email('email', Input::old('email'), array('placeholder'=>'email@mail.com'));}}<br/>
    {{Form::label('Password')}}<br/>
    {{Form::password('password');}}<br/>
    {{Form::label('Confirm password')}}<br/>
    {{Form::password('cpassword');}}<br/>
    {{Form::submit('Validate');}}
    {{Form::close() }}</p>
    
@stop