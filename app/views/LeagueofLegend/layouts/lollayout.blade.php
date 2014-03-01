<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>NsPk - League of Legend</title>
    <!-- temporaire !!!-->
    {{ HTML::style('css/styleTablesort.css'); }}
    {{ HTML::style('css/style.css'); }}
    <!--{{ HTML::script('js/jquery-2.1.0.min.js'); }}-->
    <!--{{ HTML::script('js/jquery.tablesorter.pager.js'); }}-->
    <script type="text/javascript" src="{{ URL::asset('js/jquery-2.1.0.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/jquery.tablesorter.js') }}"></script>
    <script type="text/javascript">
$(function(){
  $("table").tablesorter({widgets: ["zebra"]});
});
    </script>
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