<?php

class AuthService
{

    private static $currentUser;

    public function __construct() 
    {
    }

    public static function isAuthenticated(): bool
    {
        return isset($_SESSION['s_token']) || isset($_COOKIE['c_token']);
        //return true;
    }

    public static function connectUser(){
        self::setCurrentUser();
    }

    public static function setCurrentUser(){
        if (self::isAuthenticated()) {
            if(isset($_SESSION['s_token'])){
                self::$currentUser = UserModel::findByAuthentToken(self::getAuthToken());
            }else{
                self::setCurrentUserWithCookie();
            }
            
        }else{
            self::$currentUser = null;   
        }
    }

    public static function getCurrentUser()
    {
        return self::$currentUser;
    }

    private static function setCurrentUserWithCookie(){
        self::$currentUser = UserModel::findByCookieToken($_COOKIE['c_token']);
        if(self::$currentUser != null){
            $length = 32;
            $s_token = bin2hex(random_bytes($length));
            $_SESSION['s_token'] = $s_token;
            //setcookie('s_token', $s_token);
                    
            UserModel::setSessionToken($s_token, self::$currentUser['email']);
            
            setcookie('c_token',$_COOKIE['c_token'], time()+60*60*24*30);
        }
    }

    private static function getAuthToken()
    {
        if(!isset($_SESSION['s_token']))self::setCurrentUserWithCookie();
        return $_SESSION['s_token'];
    }

    public static function disconnect(){
        setcookie('c_token',' ',time()-3600);
        $_SESSION['s_token'] = null;
        session_destroy();
        $currentUser = null;
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