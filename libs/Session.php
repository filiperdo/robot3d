<?php

class Session
{
    
    public static function init()
    {
        @session_start();
    }
    
    public static function set($key, $value)
    {
        $_SESSION[ PREFIX_SESSION . $key ] = $value;
    }
    
    public static function get($key)
    {
        if (isset($_SESSION[ PREFIX_SESSION . $key ]))
        return $_SESSION[ PREFIX_SESSION . $key ];
    }
    
    public static function destroy()
    {
        unset($_SESSION[ PREFIX_SESSION . 'loggedIn']);
        unset($_SESSION[ PREFIX_SESSION . 'user_name']);
        unset($_SESSION[ PREFIX_SESSION . 'userid']);
        session_destroy();
    }
    
}