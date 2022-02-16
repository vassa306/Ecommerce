<?php
namespace app\classes;

class Redirect
{

    public static function to($page)
    {
        header("location: $page");
        exit();
    }

    public static function back()
    {
        $uri = $_SERVER['REQUEST_URI'];
        header("location: $uri");
        exit();
    }
}
        
    
    


