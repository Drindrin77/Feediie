<?php

if(!defined('CONST_INCLUDE'))
    die('Acces direct interdit !');

class ConnectionController extends Controller{

    private $userModel;

	public function __construct() {
        $this->userModel = new UserModel();
    }
    public function execute($action){
        switch($action){
            case "signout":
                $this->signout();
            break;
            case null:
                if(AuthService::isAuthenticated()){
                    $this->redirectUser();
                }else{
                    return new ViewModel("Connection");
                }
            break;
            default:
                $this->redirectUser();
        }        
    }

    private static function signout(){
        AuthService::disconnect();
        header("Location: /");
    }

    //TODO IMPORTANT : Appeller AuthService::connectUser() si le mec se connecte
/*
    //Verification CSRF
    public function verifyConnection(){
        if(isset($_POST['email']) && $_POST['password']){
            $mail = $_POST['email'];
            $password = $_POST['password'];
            $passwordCrypted = password_hash($password, PASSWORD_DEFAULT);
            $res = $this->userModel->verifyUserExist($mail, $passwordCrypted);
            if($res){
                if( isset($_POST['rememberMe']) && $_POST['rememberMe'] == "on"){
                    $this->createToken($mail);
                }
                $this->setUniqSession();
                header("Location: /");
            }else{

                $data = [
                    'mail' => $mail,
                    'errors' => 'Le mot de passe ou le nom d\'utilisateur est incorrect'
                ];
                $this->viewModel = new ViewModel("Connection",$data);
            }
        }else{
            $this->viewModel = new ViewModel("Connection");
        }
        //$passwordCrypted = password_hash($password, PASSWORD_DEFAULT); (Pour register)
    }*/
}

?>