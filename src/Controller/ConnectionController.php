<?php

if(!defined('CONST_INCLUDE'))
    die('Acces direct interdit !');

include_once ("ConnectionModel.php");

class ConnectionController extends Controller{
	
	public function __construct() {
		$this->model = new ConnectionModel();
    }

    public function example(){
        $data = $this->model->example();
        $this->setViewModel('Connection',[]);
    }

    public function execute($action){

    }
    
    private function createToken($email){
        session_start();
        if(isset($_COOKIE['token']) && isset($_COOKIE['email'])){
            setcookie("token", $_COOKIE['token'], mktime().time()+60*60*24*30);//expiration dans 30j
            setcookie("email", $_COOKIE['email'], mktime().time()+60*60*24*30);//expiration dans 30j
        }else{
            $token = $this->model->getSessionToken($email);
            setcookie("token", $token, mktime().time()+60*60*24*30);
            setcookie("token", $email, mktime().time()+60*60*24*30);//expiration dans 30j

        }
    }

    private function verifyToken(){
        session_start();
        if(isset($_COOKIE['token']) && isset($_COOKIE['email'])){
            if($_COOKIE['token'] == $this->model->getSessionToken($_COOKIE['email'])){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    //Verification CSRF
    public function verifyConnection(){
        if(verifyToken()){
            createToken($_COOKIE['email']);
            header("Location: /restaurant");
            return;
        }
        if(isset($_POST['email']) && $_POST['password']){
            $mail = $_POST['email'];
            $password = $_POST['password'];
            $passwordCrypted = $this->model->getPasswordByEmail($mail);
            //Test pour bien parser les inputs pour pas d'injection
            if(password_verify($password, $passwordCrypted)){
                if( isset($_POST['rememberMe']) ){
                    if($_POST['rememberMe'] == "on"){
                        $this->createToken($mail);
                    }
                }
                //Go To Pécho
                header("Location: /restaurant");
            }else{
                header("Location: /connection?email=$mail");
                //Return to Connection
            }
        }else{
            header("Location: /connection");
        }
        //$passwordCrypted = password_hash($password, PASSWORD_DEFAULT); (Pour register)
    }
}

?>