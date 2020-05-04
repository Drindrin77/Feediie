<?php
if (!defined('CONST_INCLUDE'))
    die('Acces direct interdit !');

class UserRequest extends RequestService
{

    private $currentUser;

    public function __construct()
    {
        parent::__construct();
        $this->currentUser = AuthService::getCurrentUser();
    }

    public function execute($action)
    {
        switch ($action) {
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
            case "deleteuser":
                $this->deleteUser();
                break;
            case "updateinterestedrelation":
                $this->updateInterestedRelation();
                break;
            case "setadmin":
                $this->setAdmin(true);
                break;
            case "removeadmin":
                $this->setAdmin(false);
                break;
            case "editfilter":
                $this->editFilter();
            break;
            case "like":
                $this->likeUser();
            break;
            case "dislike":
                $this->dislikeUser();
            break;
            case "report":
                $this->reportUser();
            break;
        }
    }

    private function likeUser(){
        $idLikedUser = htmlspecialchars($_POST['idLikedUser']);
        $idCurrentUser = $this->currentUser['iduser'];
        if (UserModel::likeUser($idCurrentUser, $idLikedUser)) {
            $this->addMessageSuccess("Like réussie");
        } else {
            $this->addMessageError("Erreur BD");
        }

    }

    private function dislikeUser(){
        $idDislikedUser = htmlspecialchars($_POST['idDislikedUser']);
        $idCurrentUser = $this->currentUser['iduser'];
        if (UserModel::dislikeUser($idCurrentUser, $idDislikedUser)) {
            $this->addMessageSuccess("Dislike réussie");
        } else {
            $this->addMessageError("Erreur BD");
        }
    }

    private function reportUser(){
        $idReportedUser = htmlspecialchars($_POST['idReportedUser']);
        if (UserModel::reportUser($idReportedUser)) {
            $this->addMessageSuccess("Report réussie");
        } else {
            $this->addMessageError("Erreur BD");
        }
    }

    private function editFilter(){

        $args = array();
        $idUser = $this->currentUser['iduser'];

        if(isset($_POST['distance'])){
            $args['distanceMax']=htmlspecialchars($_POST['distance']);
        }
        if(isset($_POST['ageMin'])){
            $args['filterAgeMin']=htmlspecialchars($_POST['ageMin']);
        }
        if(isset($_POST['ageMax'])){
            $args['filterAgeMax']=htmlspecialchars($_POST['ageMax']);
        }

        if(!empty($args)){
            UserModel::editInfo($args,$idUser);
        }

        if(isset($_POST['changesSex'])){
            $changesSex = $_POST['changesSex'];
            foreach($changesSex as $sex){
                if($sex['status']=='true'){
                    SexModel::addUserSelectedSex($idUser, $sex['id']);
                }else{
                    SexModel::removeUserSelectedSex($idUser, $sex['id']);
                }
            }            
        }

        DietModel::removeUserSelectedDiet($idUser);

        if(isset($_POST['valuesDiet'])){            
            $valuesDiet = $_POST['valuesDiet'];
            foreach($valuesDiet as $diet){
                DietModel::updateUserSelectedDiet($idUser, $diet['id'], $diet['value']);
            }
        }
    }

    private function setAdmin($admin)
    {
        $idUser = htmlspecialchars($_POST['idUser']);
        if ($admin) {
            if (UserModel::promuteAdmin($idUser)) {
                $this->addMessageSuccess("Promotion réussie");
            } else {
                $this->addMessageError("Erreur BD");
            }
        } else {
            if (UserModel::destituteAdmin($idUser)) {
                $this->addMessageSuccess("Destitution réussie");
            } else {
                $this->addMessageError("Erreur BD");
            }
        }

    }


    private function deleteUser()
    {
        $idUser = htmlspecialchars($_POST['id']);

        if (UserModel::deleteUser($idUser)) {
            $this->addMessageSuccess("Ajout réussi");
        } else {
            $this->addMessageError("Erreur BD");
        }
    }

    private function updateInterestedRelation()
    {
        //ON RECUPERE LA RELATION DE CURRENTUSER
        $idUser = $this->currentUser['iduser'];
        $idRelation = htmlspecialchars($_POST['id']);
        $value = htmlspecialchars($_POST["value"]);
        $value = $value=='true'?true:false;
        if ($value){ 
            ParameterModel::addUserSelectedRelation($idUser, $idRelation);
        }
        else{
            ParameterModel::removeUserSelectedRelation($idUser, $idRelation); 
            $this->addMessageSuccess('Les relations ont ete mises a jour');
        } 
    }

    //XSS HACK : HTMLSPECIALCHARS ?
    private function resetPassword()
    {
        $oldPassword = isset($_POST['oldPassword']) && !empty($_POST['oldPassword']) ? $_POST['oldPassword'] : null;
        $newPassword = isset($_POST['newPassword']) && !empty($_POST['newPassword']) ? $_POST['newPassword'] : null;
        $actualPassword = $this->currentUser['password'];

        if (!PasswordService::samePassword($oldPassword, $actualPassword)) {
            $this->addMessageError('L\'ancien mot de passe est incorrect.');
        } else {
            UserModel::resetPassword(PasswordService::hashPassword($newPassword, PASSWORD_DEFAULT));
            $this->changeCookieToken(AuthService::getCurrentUser()['email']);
            AuthService::connectUser();
            $this->addMessageSuccess('Le mot de passe a été réinitialisé');
        }
    }

    private function editInfo()
    {
        if (AuthService::isAuthenticated()) {
            if (!UserModel::editInfo($_POST, $this->currentUser['iduser'])) {
                $this->addMessageSuccess('Erreur BD');
            } else {
                $this->addMessageSuccess('Les nouvelles informations ont été pris en compte');
            }
        }
    }


    private function connection()
    {
        $email = isset($_POST['email']) ? $_POST['email'] : null;
        $password = isset($_POST['password']) ? $_POST['password'] : null;
        if (!empty(UserModel::getUserByMail($email)['password'])) {
            $passwordEncrypted = UserModel::getUserByMail($email)['password'];
            if (PasswordService::samePassword($password, $passwordEncrypted)) {
                $token = UserModel::getUserByMail($email)['token'];
                if ($_POST['rememberMe'] == "true") {
                    session_destroy();
                    session_set_cookie_params(3600 * 24, "/");
                    session_start();
                }
                $_SESSION['token'] = $token;
                AuthService::connectUser();
                $user = AuthService::GetCurrentUser();
                if ($user['description'] == null && empty(PhotoModel::getAllPhotos($user['iduser']))) {
                    $this->addData("page", "/profile/edit");
                } else {
                    $this->addData("page", "/");
                }
                $this->addMessageSuccess("connect");
            } else {
                $this->addMessageError("rate");
            }
        } else {
            $this->addMessageError("rate");
        }
    }

    private function passwordForgotten()
    {
        $email = isset($_POST['emailForgotten']) ? $_POST['emailForgotten'] : null;

        $token = UserModel::getUserByMail($email)['token'];
        $link = "https://www.feediie.com/resetpassword/$token";
        mail(str($email), "Reset Password Feediie", "Follow this link to reset your password : $link");
    }

    private function changeCookieToken($mail)
    {
        $length = 32;
        $token = bin2hex(random_bytes($length));
        while (!empty(UserModel::findByToken($token))) {
            $token = bin2hex(random_bytes($length));
        }
        UserModel::setToken($token, $mail);
        session_destroy();
        session_set_cookie_params(3600 * 24, "/");
        session_start();
        $_SESSION['token'] = $token;
    }

    private function register()
    {
        $errors = array();
        $isValid = true;

        $firstName = isset($_POST['firstname']) ? $_POST['firstname'] : null;
        $email = isset($_POST['email']) ? $_POST['email'] : null;
        $password = isset($_POST['password']) ? $_POST['password'] : null;
        $birthday = isset($_POST['birthday']) ? $_POST['birthday'] : null;
        $sex = isset($_POST['sex']) ? $_POST['sex'] : null;
        $city = isset($_POST['city']) ? $_POST['city'] : null;
        $age = isset($_POST['age']) ? $_POST['age'] : null;

        if (!EmailService::checkEmailFormat($email)) {
            $this->addMessageError("Le format de l'email n'est pas valide");
            $isValid = false;
        }
        if (!empty(UserModel::getUserByMail($email))) {
            $this->addMessageError("Email déjà utilisée");
            $isValid = false;
        }

        if (!DateService::checkDateFormat($birthday)) {
            $this->addMessageError("Le format de la date n'est pas valide");
            $isValid = false;
        }
        if (!PasswordService::checkPasswordFormat($password)) {
            $this->addMessageError(PasswordService::policyToString());
            $isValid = false;
        }
        if (empty(SexModel::getSexWithName($sex))) {
            $this->addMessageError("Le sexe n'est pas valide");
            $isValid = false;
        }
        if (empty(CityModel::getCityWithID($city))) {
            $this->addMessageError("La ville n'est pas valide");
            $isValid = false;
        }

        if ($isValid) {
            $passwordEncrypted = PasswordService::hashPassword($password);
            $uniqID = bin2hex(random_bytes(32));
            $token = bin2hex(random_bytes(32));
            $ageMin = $age - 5 < 18 ? 18 : $age - 5;
            $ageMax = $age + 5 > 60 ? 60 : $age + 5;
            while (!empty(UserModel::getUserByUniqID($uniqID))) {
                $uniqID = bin2hex(random_bytes(32));
            }
            while (!empty(UserModel::findByToken($token))) {
                $token = bin2hex(random_bytes(32));
            }
            $res = UserModel::signUp($firstName, $email, $passwordEncrypted, $birthday, $sex, intval($city), $uniqID, $token, $ageMin, $ageMax);
            if ($res) {
                $this->addMessageSuccess("validate");
            } else {
                $this->addMessageError('ERREUR BD');
            }
        }
    }
}

?>
