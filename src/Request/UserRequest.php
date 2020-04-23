<?php
if(!defined('CONST_INCLUDE'))
	die('Acces direct interdit !'); 

class UserRequest extends RequestService{
    
    private $currentUser;
	public function __construct() {
        parent::__construct();
        $this->currentUser = AuthService::getCurrentUser();
    }	

    public function execute($action){
        switch($action){
            case "resetpassword":
                $this->resetPassword();
            break;
            case "connection":
                $this->connection();
            break;
            case "editinfo":
                $this->editInfo();
            break;
            case "passwordforgotten":
                $this->passwordForgotten();
            break;
            case "addhobby":
                $this->addHobby();
            break;
            case "removehobby":
                $this->removeHobby();
            break;
            case "filter":
                $this->filter();
            break;
        }
    }    

    private function filter(){
        $distance = $_POST['distance'];
        $idUser = $this->currentUser['iduser'];

        //UserModel::setFilterParameter($args); 
        //$newUsersFiltered = UserModel::getUsersFiltered($args)
        //TODO DOUBLE FILTRAGE

        /*
        if (REUSSITE BD){
            $this->addMessageSuccess('Le hobby a été supprimé');
            $this->addData($newUsersFiltered)
        }else{
            $this->addMessageError('Erreur BD');
        }

        */
    }

    private function removeHobby(){
        $idUser = $this->currentUser['iduser'];
        $idHobby = isset($_POST['idHobby']) && !empty($_POST['idHobby']) ? $_POST['idHobby'] : null;
        if(UserModel::removeHobby($idUser, $idHobby)){
            $this->addMessageSuccess('Le hobby a été supprimé');
        }else{
            $this->addMessageError('Erreur BD');
        }
    }

    private function addHobby(){
        $idUser = $this->currentUser['iduser'];
        $idHobby = isset($_POST['idHobby']) && !empty($_POST['idHobby']) ? $_POST['idHobby'] : null;
        if(UserModel::addHobby($idUser, $idHobby)){
            $this->addMessageSuccess('Le hobby a été ajouté');
        }else{
            $this->addMessageError('Erreur BD');
        }
    }

    //XSS HACK : HTMLSPECIALCHARS ?
    private function resetPassword(){
        $oldPassword = isset($_POST['oldPassword']) && !empty($_POST['oldPassword']) ? $_POST['oldPassword'] : null;
        $newPassword = isset($_POST['newPassword']) && !empty($_POST['newPassword']) ? $_POST['newPassword'] : null;
        $actualPassword = $this->currentUser['password'];
        
        if(!PasswordService::samePassword($oldPassword,$actualPassword)){
            $this->addMessageError(['old'=>'L\'ancien mot de passe est incorrect.']);  
        }  
        else{
            UserModel::resetPassword(PasswordService::hashPassword($newPassword, PASSWORD_DEFAULT));
            $this->addMessageSuccess('Le mot de passe a été réinitialisé');
        }
    }

    private function editInfo(){
        $idUser = $this->currentUser['iduser'];
        if(!UserModel::editInfo($_POST, $idUser)){
            $this->addMessageSuccess('Erreur BD');
        }else{
            $this->addMessageSuccess('Les nouvelles informations ont été pris en compte');
        }
    }


    private function connection(){
        $email = isset($_POST['email'])? $_POST['email'] : null;
        $password = isset($_POST['password'])? $_POST['password'] : null;
        if(isset(UserModel::getUserByMail($email)['password'])){
            $passwordEncrypted = UserModel::getUserByMail($email)['password'];
            if(password_verify($password, $passwordEncrypted)){
                $length = 32;
                $s_token = bin2hex(random_bytes($length));
                setcookie('s_token', $s_token);
                
                UserModel::setSessionToken($s_token, $email);

                if($_POST['rememberMe'] == "true"){
                    setcookie('c_token',UserModel::getUserByMail($email)['token'], time()+60*60*24*30);
                }
                $this->addMessageSuccess("connect");
            }else{
                $this->addMessageSuccess("rate");
            }
        } 
        $this->addMessageSuccess("rate");
    }

    private function passwordForgotten(){
        $email = isset($_POST['emailForgotten'])? $_POST['emailForgotten'] : null;

        $token = UserModel::getUserByMail($email)['token'];
        $link = "https://www.feediie.com/resetpassword/$token";
        mail(str($email) , "Reset Password Feediie", "Follow this link to reset your password : $link");
    }

}

?>
