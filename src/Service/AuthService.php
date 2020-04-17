<?php

class AuthService
{

    private static $currentUser;

    public function __construct() 
    {
    }

    public static function isAuthenticated(): bool
    {
        //return isset($_SESSION['uniqid']) || isset($_COOKIE['token']);
        return true;
    }

    public static function connectUser(){
        self::setCurrentUser();
    }

    public static function setCurrentUser(){
        if (self::isAuthenticated()) {
            self::$currentUser = UserModel::findByAuthentToken(self::getAuthToken());
        }else{
            self::$currentUser = null;   
        }
    }

    public static function getCurrentUser()
    {
        return self::$currentUser;
    }

    private static function getAuthToken()
    {
        //return $_SESSION['uniqid'];
        return 'token';
    }

    private static function setUniqSession(){
        //TODO: DATABASE SET 
        //$_SESSION['uniqid'] = bin2hex(random_bytes(32));
    }

    private static function createToken($email){
        /*$token = $this->model->getSessionToken($email);
        setcookie("token", $token, time()+60*60*24*30);
        setcookie("token", $email, time()+60*60*24*30);//expiration dans 30j*/
    }

    private function verifyToken(){
        /*if(isset($_COOKIE['token']) && isset($_COOKIE['email'])){
            if($_COOKIE['token'] == $this->model->getSessionToken($_COOKIE['email'])){
                createToken($_COOKIE['email']);
                $this->setUniqSession();
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }*/
    }

    public static function setNewToken($token)
    {
        //TODO : Cookie
        //Todo : $_SESSION 
        //TODO BD UserModel set token
    }
    
}