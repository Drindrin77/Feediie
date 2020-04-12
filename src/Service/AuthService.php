<?php

class AuthService
{
    private $userModel;

    public function __construct() 
    {
        $this->userModel = new UserModel();
    }

    public static function isAuthenticated(): bool
    {
        return isset($_SESSION['token']) || isset($_COOKIE['token']);
    }

    public static function getCurrentUser()
    {
        if (self::isAuthenticated()) {
            return $this->userModel->findByAuthentToken(self::getAuthToken());
        }
        return null;
    }

    private static function getAuthToken()
    {
        return $_SESSION['token'];
    }
    
}