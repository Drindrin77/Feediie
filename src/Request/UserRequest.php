<?php
if(!defined('CONST_INCLUDE'))
	die('Acces direct interdit !'); 

class UserRequest extends RequestService{
	
	public function __construct() {
        parent::__construct();
    }	

    public function execute(){
        $action = isset($_GET['action'])?$_GET['action']:null;
        switch($action){
            case "resetpassword":
                $this->resetPassword();
            break;
            case "connection":
                $this->connection();
            break;
            case "passwordforgotten":
                $this->passwordForgotten();
            break;
        }
    }    

    //XSS HACK : HTMLSPECIALCHARS ?
    private function resetPassword(){
        $oldPassword = isset($_POST['oldPassword']) && !empty($_POST['oldPassword']) ? $_POST['oldPassword'] : null;
        $newPassword = isset($_POST['newPassword']) && !empty($_POST['newPassword']) ? $_POST['newPassword'] : null;
        $actualPassword = AuthService::getCurrentUser()['password'];
        
        if(!PasswordService::samePassword($oldPassword,$actualPassword)){
            $this->addMessageError(['old'=>'L\'ancien mot de passe est incorrect.']);  
        }  
        else{
            UserModel::resetPassword(PasswordService::hashPassword($newPassword, PASSWORD_DEFAULT));
            $this->addMessageSuccess('Le mot de passe a été réinitialisé');
        }
    }

    private function connection(){
        $email = isset($_POST['email'])? $_POST['email'] : null;
        $password = isset($_POST['password'])? $_POST['password'] : null;
        
        $passwordEncrypted = UserModel::getUserByMail($email)['password'];
        if(!isset($passwordEncrypted))$this->addMessageSuccess("Raté");
        if(password_verify($password, $passwordEncrypted)){
            $length = 32;
            $_SESSION['s_token'] = bin2hex(random_bytes($length));
            UserModel::setSessionToken($_SESSION['s_token'], $email);
            $_COOKIE['c_token'] = UserModel::getUserByMail($email)['token'];
            $this->addMessageSuccess("Connecté");
        }else{
            $this->addMessageSuccess("Raté");
        }
    }

    private function passwordForgotten(){
        $email = isset($_POST['emailForgotten'])? $_POST['emailForgotten'] : null;

        $token = UserModel::getUserByMail($email)['token'];
        $link = "https://www.feediie.com/resetpassword/$token";
        mail(str($email) , "Reset Password Feediie", "Follow this link to reset your password : $link");
    }

}

?>
