<?php
if(!defined('CONST_INCLUDE'))
	die('Acces direct interdit !'); 

class UserRequest extends RequestService{
	
	public function __construct() {
        parent::__construct();
    }	

    public function execute($action){
        switch($action){
            case "resetpassword":
                $this->resetPassword();
            break;
            case "connection":
                $this->connection();
            break;
            case "register":
                $this->register();
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

    //Attention aux insertions SQL
    private function connection(){
        $email = isset($_POST['email'])? $_POST['email'] : null;
        $password = isset($_POST['password'])? $_POST['password'] : null;
        if(isset(UserModel::getUserByMail($email)['password'])){
            $passwordEncrypted = UserModel::getUserByMail($email)['password'];
            if(PasswordService::samePassword($password, $passwordEncrypted)){
                $length = 32;
                $s_token = bin2hex(random_bytes($length));
                setcookie('s_token', $s_token);
                
                UserModel::setSessionToken($s_token, $email);

                if($_POST['rememberMe'] == "true"){
                    setcookie('c_token',UserModel::getUserByMail($email)['token'], time()+60*60*24*30);
                }
                AuthService::connectUser();
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

    private function register(){
        $errors = array();
        $isValid = true;

        $name = isset($_POST['name'])? $_POST['name'] : null;
        $firstName = isset($_POST['firstname'])? $_POST['firstname'] : null;
        $email = isset($_POST['email'])? $_POST['email'] : null;
        $password = isset($_POST['password'])? $_POST['password'] : null; 
        $birthday = isset($_POST['birthday'])? $_POST['birthday'] : null;
        $sex = isset($_POST['sex'])? $_POST['sex'] : null;
        $city = isset($_POST['city'])? $_POST['city'] : null;

        if( !EmailService::checkEmailFormat($email)){
            $this->addMessageError("Le format de l'email n'est pas valide");
            $isValid = false;
        }
        if( !empty( UserModel::getUserByMail($email)) ) {
            $this->addMessageError("Email déjà utilisée");
            $isValid = false;
        }

        if( !DateService::checkDateFormat($birthday) ){
            $this->addMessageError("Le format de la date n'est pas valide");
            $isValid = false;
        }
        if( !PasswordService::checkPasswordFormat($password) ){
            $this->addMessageError(PasswordService::policyToString());
            $isValid = false;
        }
        if( empty( SexModel::getSexWithName($sex) ) ){
            $this->addMessageError("Le sexe n'est pas valide");
            $isValid = false;
        }
        if ( empty( CityModel::getCityWithID($city) ) ){
            $this->addMessageError("La ville n'est pas valide");
            $isValid = false;
        }
        
        if($isValid){
            $passwordEncrypted = PasswordService::hashPassword($password);
            $uniqID = bin2hex(random_bytes(32));
            while( !empty( UserModel::getUserByUniqID($uniqID) ) ){
                $uniqID = bin2hex(random_bytes(32));
            }
            $res = UserModel::signUp($firstName, $name, $email, $passwordEncrypted, $birthday, $sex, intval($city), $uniqID);

            if ( $res ){
                $this->addMessageSuccess("validate");
            }else{
                $this->addMessageError('ERREUR BD');
            }
        }
    }
}

?>
