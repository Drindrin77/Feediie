<?php

if(!defined('CONST_INCLUDE'))
    die('Acces direct interdit !');

class ConnectionController extends Controller{
    
    private $userModel;

	public function __construct() {
        $this->userModel = new UserModel();
    }


    public function execute($action){

        var_dump($action);
        switch($action){
            case "verifyconnection":
                $this->verifyConnection();
            break;
            default:
                $this->viewModel = new ViewModel("Connection");
            break;
        }
    }

    private function setUniqSession(){
        //TODO: DATABASE SET 
        $_SESSION['uniqid'] = bin2hex(random_bytes(32));
    }

    private function createToken($email){
        $token = $this->model->getSessionToken($email);
        setcookie("token", $token, time()+60*60*24*30);
        setcookie("token", $email, time()+60*60*24*30);//expiration dans 30j
    }

    private function verifyToken(){
        session_start();
        if(isset($_COOKIE['token']) && isset($_COOKIE['email'])){
            if($_COOKIE['token'] == $this->model->getSessionToken($_COOKIE['email'])){
                createToken($_COOKIE['email']);
                $this->setUniqSession();
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
            echo "????";
            $this->viewModel = new ViewModel("Connection");
        }
        //$passwordCrypted = password_hash($password, PASSWORD_DEFAULT); (Pour register)
    }

}

?>