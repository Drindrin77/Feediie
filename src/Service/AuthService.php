<?php

class AuthService
{

    private static $currentUser;

    public function __construct() 
    {
    }

    public static function isAuthenticated(): bool
    {
        return isset($_SESSION['token']);
    }

    public static function connectUser(){
        self::setCurrentUser();
    }

    public static function setCurrentUser(){
        if (self::isAuthenticated()) {
            self::$currentUser = UserModel::findByToken(self::getAuthToken());
        }else{
            self::$currentUser = null;   
        }
    }

    public static function getCurrentUser(){
        return self::$currentUser;
    }

    private static function getAuthToken(){
        return $_SESSION['token'];
    }

    public static function disconnect(){
        $_SESSION['s_token'] = null;
        session_destroy();
        $currentUser = null;
    }

    public static function isAdmin(){
        return self::$currentUser['isadmin'];  
    }    
}