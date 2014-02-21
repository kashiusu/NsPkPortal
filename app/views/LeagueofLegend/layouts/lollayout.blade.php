<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>NsPk - League of Legend</title>
</head>
<body>
    <h1>League of Legend</h1>
    <ul>
        <li><a href="{{URL::route('home')}}">Home</a></li>
        @if(Auth::check())
            @if(Auth::user()->permission_id == 0)
            <li><a href="{{URL::route('manage_summoner')}}">manage summoner</a></li>
            <li><a href="{{URL::route('manage_item')}}">manage item</a></li>
            @else
            <li><a href="{{URL::route('add_summoner')}}">Add summoner</a></li>
            @endif
        @endif
    </ul>
    @include('LeagueofLegend/layouts/account')
    @yield('content')
</body>
</html>