<?php
if(!defined('CONST_INCLUDE'))
	die('Acces direct interdit !'); 

class PersonalityRequest extends RequestService{
    
    private $currentUser;
	public function __construct() {
        parent::__construct();
        $this->currentUser = AuthService::getCurrentUser();
    }	

    public function execute($action){
        switch($action){
            case "deleteuserpersonality":
                $this->deleteUserPersonality();
            break;
            case "adduserpersonality":
                $this->addUserPersonality();
            break;
            case "deletepersonality":
                $this->deletePersonality();
            break;
            case "addpersonality":
                $this->addPersonality();
            break;

        }
    }    

    private function addPersonality(){
        $name = htmlspecialchars($_POST['name']);
        $base64 = htmlspecialchars($_POST['base64Img']);
        $ext = htmlspecialchars($_POST['ext']);
        $fileName = PhotoService::createFilename(PATH_PERSONALITY_PHOTO,$ext);

        if(PersonalityModel::addPersonality($name,  substr($fileName,1))){
            $this->addMessageSuccess("Ajout reussi");
            $id = PersonalityModel::getIDByName($name);
            PhotoService::base64ToFile($base64, $fileName);
            $this->addData('id',$id);
            $this->addData('url',$fileName);
        }else{
            $this->addMessageError("Le nom est déjà pris");
        }
    }

    private function deletePersonality(){
        $idDish = htmlspecialchars($_POST['id']);
        $url = PersonalityModel::getUrlbyId($idDish);
        if(PersonalityModel::deletePersonality($idDish)){
            PhotoService::deletePhoto($url);
            $this->addMessageSuccess("Suppression reussi");
        }else{
            $this->addMessageError("Erreur BD");
        }
    }

    private function addUserPersonality(){
        $idDish = htmlspecialchars($_POST['idDish']);
        $idUser = $this->currentUser['iduser'];
        if(PersonalityModel::addUserPersonality($idUser, $idDish)){
            $this->addMessageSuccess("Ajout reussi");
        }else{
            $this->addMessageError("Erreur BD");
        }
    }

    private function deleteUserPersonality(){
        $idDish = htmlspecialchars($_POST['idDish']);
        $idUser = $this->currentUser['iduser'];
        if(PersonalityModel::deleteUserPersonality($idUser, $idDish)){
            $this->addMessageSuccess("Suppression reussi");
        }else{
            $this->addMessageError("Erreur BD");
        }
    }

}

?>
