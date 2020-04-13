<?php

class AuthService
{
    public function __construct() 
    {
    }

    public static function isAuthenticated(): bool
    {
        return isset($_SESSION['uniqid']) || isset($_COOKIE['token']);
    }

    public static function getCurrentUser()
    {
        if (self::isAuthenticated()) {
            $userModel = new UserModel();
            return $userModel->findByAuthentToken(self::getAuthToken());
        }
        return null;
    }

    private static function getAuthToken()
    {
        return $_SESSION['uniqid'];
        //return 'token';
    }
    
}