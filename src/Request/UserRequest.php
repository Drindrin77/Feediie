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
            break;
            case "editinfo":
                $this->editInfo();
            break;
            case "passwordforgotten":
                $this->passwordForgotten();
            break;
            case "filter":
                $this->filter();
            break;
            case "delete":
                $this->delete();
            break;
            case "setadmin":
                $this->setAdmin(true);
            break;
            case "removeadmin":
                $this->setAdmin(false);
            break;
        }
    }    

    private function setAdmin($admin){
        $idUser= htmlspecialchars($_POST['idUser']);
        if($admin){
            if(UserModel::promuteAdmin($idUser)){
                $this->addMessageSuccess("Promotion réussie");
            }else{
                $this->addMessageError("Erreur BD");
            }
        }else{
            if(UserModel::destituteAdmin($idUser)){
                $this->addMessageSuccess("Destitution réussie");
            }else{
                $this->addMessageError("Erreur BD");
            }
        }
        
    }


    private function delete(){
        $idUser= htmlspecialchars($_POST['id']);

        if(UserModel::deleteUser($idUser)){
            $this->addMessageSuccess("Ajout réussi");
        }else{
            $this->addMessageError("Erreur BD");
        }
    }

    private function filter(){
	    //ON RECUPERE LES INFORMATIONS PROVENANT DES PARAMETRES
        $distance = $_POST['distanceMax'];
        $ageMin = $_POST['ageRangemin'];
        $sexSelect = $_POST['sexSelect'];
        $dietSelect = $_POST['dietSelect'];
        $relationSelect = $_POST['relationSelect'];
        $ageMax = $_POST['ageRangemax'];
        $idUser = $this->currentUser['iduser']; 



        if(ParameterModel::updateDistance($idUser, $distance)){
            $this->addMessageSuccess('La distance a ete mise a jour');
        }
        else{
            $this->addMessageError('Erreur BD mise a jour distance');
        }
        if(ParameterModel::updateAge($idUser, $ageMin, $ageMax)){
            $this->addMessageSuccess('L age a ete mis a jour');
        }
        else{
            $this->addMessageError('Erreur BD mise a jour age');
        }
        if(SexModel::removeUserSelectedSex($idUser))
        {
            $this->addMessageSuccess('Table selectsex vide');
        }
        foreach ($sexSelect as $sex) {
            if (SexModel::updateUserSelectedSex($idUser, $sex)) {
                $this->addMessageSuccess('Les sexs on ete mis a jour');
            } else {
                $this->addMessageError('Erreur BD mise a jour sex selectionne');
            }
        }
        if(DietModel::removeUserSelectedDiet($idUser))
        {
            $this->addMessageSuccess('Table selectdiet vide');
        }
        foreach ($dietSelect as $diet) {
            if (DietModel::updateUserSelectedDiet($idUser, $diet)) {
                $this->addMessageSuccess('Les diets on ete mis a jour');
            } else {
                $this->addMessageError('Erreur BD mise a jour diet selectionne');
            }
        }
        if(ParameterModel::removeUserSelectedRelation($idUser))
        {
            $this->addMessageSuccess('Table selectrelation vide');
        }
        foreach ($relationSelect as $relation) {
            if (ParameterModel::updateUserSelectedRelation($idUser, $relation)) {
                $this->addMessageSuccess('Les relations on ete mis a jour');
            } else {
                $this->addMessageError('Erreur BD mise a jour relations selectionne');
            }
        }
        //ON RECUPÈRE LES DONNEES DE CURRENT USER
        $infoUser = UserModel::getInfoUser($idUser);
        foreach ($sexSelect as $sex) {
            $idUserSelect = SexModel::getUserByGender($sex,$infoUser['sex']);

        }
        //$newUsersFiltered = UserModel::getUsersFiltered($idUser,)
        //TODO DOUBLE FILTRAGE

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
            AuthService::connectUser();
            $this->addMessageSuccess('Le mot de passe a été réinitialisé');
        }
    }

    private function editInfo(){
        if(AuthService::isAuthenticated()){
            if(!UserModel::editInfo($_POST, $this->currentUser['iduser'])){
                $this->addMessageSuccess('Erreur BD');
            }else{
                $this->addMessageSuccess('Les nouvelles informations ont été pris en compte');
            }
        }   
    }


    private function connection(){
        $email = isset($_POST['email'])? $_POST['email'] : null;
        $password = isset($_POST['password'])? $_POST['password'] : null;
        if(!empty(UserModel::getUserByMail($email)['password'])){
            $passwordEncrypted = UserModel::getUserByMail($email)['password'];
            if(PasswordService::samePassword($password, $passwordEncrypted)){
                $token = UserModel::getUserByMail($email)['token'];
                if($_POST['rememberMe'] == "true"){
                    session_destroy();
                    session_set_cookie_params(3600*24,"/");
                    session_start();
                }
                $_SESSION['token'] = $token;
                AuthService::connectUser();
                $user = AuthService::GetCurrentUser();
                if($user['description'] == null && empty(PhotoModel::getAllPhotos($user['iduser']))){
                    $this->addData("page", "/profile/edit");
                }else{
                    $this->addData("page", "/");
                }
                $this->addMessageSuccess("connect");
            }else{
                $this->addMessageError("rate");
            }
        }else{
            $this->addMessageError("rate");
        }
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
        while (!empty(UserModel::findByToken($token))) {
            $token = bin2hex(random_bytes($length));
        }
        UserModel::setToken($token ,$mail);
        session_destroy();
        session_set_cookie_params(3600*24,"/");
        session_start();
        $_SESSION['token'] = $token;
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
        $age = isset($_POST['age'])? $_POST['age'] : null;

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
            $ageMin = $age-5< 18? 18:$age-5;
            $ageMax = $age+5 >60?60:$age+5;
            while( !empty( UserModel::getUserByUniqID($uniqID) ) ){
                $uniqID = bin2hex(random_bytes(32));
            }
            while (!empty(UserModel::findByToken($token))) {
                $token = bin2hex(random_bytes(32));
            }
            $res = UserModel::signUp($firstName, $email, $passwordEncrypted, $birthday, $sex, intval($city), $uniqID, $token, $ageMin, $ageMax);
            if ( $res ){
                $this->addMessageSuccess("validate");
            }else{
                $this->addMessageError('ERREUR BD');
            }
        }
    }
}

?>
