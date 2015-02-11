<?php

/* 
 * A view controller to display our Front end.
 */

class renderEngine
{
    public static function renderView($page)
    {
        if($page == "index")
        {
            header('location:'.$page.'.php');
        }else{
            header('location:../views/'.$page.'.php');
        }
    }
}