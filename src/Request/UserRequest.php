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
}

?>
