@extends('LeagueofLegend/layouts/lollayout')

@section('content')

<!--
    Ajout de Summoner
-->
@foreach($errors->all() as $message)
    <p style="color: red; font-weight: bold">{{$message}}</p>

@endforeach
<p>
    {{Form::open(array('url' => URL::route('manage_add'))) }}
    {{Form::label('name','Summoner Name')}} : {{Form::text('name', Input::old('name'))}} {{Form::submit('Ajouter')}}
    {{ Form::close() }}
</p>
<!--
    Gestion des Summoners 
-->
    <span style='color: red'>{{Session::get('message')}} 
    {{Session::get('delete_message')}}    </span>
    <?php $Summoners = Summoner::all(); ?>
    @foreach($Summoners as $Sum)
    <p> <a href='summoner/{{$Sum->id}}'>{{$Sum->name}} </a>
            {{ Form::open(array('url' => URL::route('renew'))) }}
            {{Form::hidden('id', $Sum->id) }}
            {{Form::submit('Renew data')}}
            {{ Form::close()}}
            {{ Form::open(array('url' => URL::route('manage_delete'))) }}
            {{Form::hidden('id', $Sum->id) }}
            {{Form::submit('Delete')}}
            {{ Form::close()}}  
        </p>
    @endforeach

@stop