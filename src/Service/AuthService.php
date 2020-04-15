<?php

class AuthService
{

    private $userModel;

    public function __construct() 
    {
        $userModel = new UserModel();
    }

    public static function isAuthenticated(): bool
    {
        //return isset($_SESSION['uniqid']) || isset($_COOKIE['token']);
        return true;
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
        //return $_SESSION['uniqid'];
        return 'token';
    }

    private function setUniqSession(){
        //TODO: DATABASE SET 
        //$_SESSION['uniqid'] = bin2hex(random_bytes(32));
    }

    private function createToken($email){
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

    public function setNewToken($token)
    {
        //TODO : Cookie
        //Todo : $_SESSION 
        //TODO BD UserModel set token
    }
    
}