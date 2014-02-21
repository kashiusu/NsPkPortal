<?php
    if (Auth::check()){
    echo Auth::user()->name
        . '<br/><a href="'.URL::route('logout').'">logout</a>';
    }else{
        echo '<ul>
        <li><a href="'. URL::route('login') .'">login</a></li>
        <li><a href="'. URL::route('register') .'">register</a>
    </ul>';
        
    }
 ?>