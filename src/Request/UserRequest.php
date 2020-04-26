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
            case "register":
                $this->register();
            case "editinfo":
                $this->editInfo();
            break;
            case "passwordforgotten":
                $this->passwordForgotten();
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

    //XSS HACK : HTMLSPECIALCHARS ?
    private function resetPassword(){
        $oldPassword = isset($_POST['oldPassword']) && !empty($_POST['oldPassword']) ? $_POST['oldPassword'] : null;
        $newPassword = isset($_POST['newPassword']) && !empty($_POST['newPassword']) ? $_POST['newPassword'] : null;
        $actualPassword = $this->currentUser['password'];
        
        if(!PasswordService::samePassword($oldPassword,$actualPassword)){
            $this->addMessageError('L\'ancien mot de passe est incorrect.');  
        }  
        else{
            UserModel::resetPassword(PasswordService::hashPassword($newPassword, PASSWORD_DEFAULT));
            $this->changeCookieToken(AuthService::getCurrentUser()['email']);
            $this->addMessageSuccess('Le mot de passe a été réinitialisé');
        }
    }

    private function editInfo(){
        if(AuthService::isAuthenticated()){
            $idUser = AuthService::getCurrentUser()['iduser'];
            if(!UserModel::editInfo($_POST, $idUser)){
                $this->addMessageSuccess('Erreur BD');
            }else{
                $this->addMessageSuccess('Les nouvelles informations ont été pris en compte');
            }
        }   
    }


    private function connection(){
        $email = isset($_POST['email'])? $_POST['email'] : null;
        $password = isset($_POST['password'])? $_POST['password'] : null;
        if(isset(UserModel::getUserByMail($email)['password'])){
            $passwordEncrypted = UserModel::getUserByMail($email)['password'];
            if(PasswordService::samePassword($password, $passwordEncrypted)){
                $length = 32;
                $s_token = bin2hex(random_bytes($length));
                if($_POST['rememberMe'] == "true"){
                    
                    session_destroy();
                    session_set_cookie_params(3600*24,"/");
                    session_start();
                }
                $_SESSION['s_token'] = $s_token;
                //setcookie('s_token', $s_token);
                UserModel::setSessionToken($s_token, $email);
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

    private function changeCookieToken($mail){
        $length = 32;
        $token = bin2hex(random_bytes($length));
        while (!empty(UserModel::findByCookieToken($token))) {
            $token = bin2hex(random_bytes($length));
        }
        UserModel::setCookieToken($mail);
    }

    private function register(){
        $errors = array();
        $isValid = true;

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
            $token = bin2hex(random_bytes(32));
            while( !empty( UserModel::getUserByUniqID($uniqID) ) ){
                $uniqID = bin2hex(random_bytes(32));
            }
            while (!empty(UserModel::findByCookieToken($token))) {
                $token = bin2hex(random_bytes(32));
            }
            $res = UserModel::signUp($firstName, $email, $passwordEncrypted, $birthday, $sex, intval($city), $uniqID, $token);
            if ( $res ){
                $this->addMessageSuccess("validate");
            }else{
                $this->addMessageError('ERREUR BD');
            }
        }
    }
}

?>
