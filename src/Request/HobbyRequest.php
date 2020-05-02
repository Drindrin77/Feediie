<?php
if(!defined('CONST_INCLUDE'))
	die('Acces direct interdit !'); 

class HobbyRequest extends RequestService{
    
    private $currentUser;
	public function __construct() {
        parent::__construct();
        $this->currentUser = AuthService::getCurrentUser();
    }	

    public function execute($action){
        switch($action){
            case "adduserhobby":
                $this->addUserHobby();
            break;
            case "deleteuserhobby":
                $this->deleteUserHobby();
            break;
            case "addhobby":
                $this->addHobby();
            break;
            case "deletehobby":
                $this->deleteHobby();
            break;

        }
    }    

    private function deleteHobby(){
        $idHobby = isset($_POST['idHobby']) && !empty($_POST['idHobby']) ? $_POST['idHobby'] : null;
        if(HobbyModel::deleteHobby($idHobby)){
            $this->addMessageSuccess('Le hobby a été supprimé');
        }else{
            $this->addMessageError('Erreur BD');
        }
    }

    private function addHobby(){
        $name = htmlspecialchars($_POST['name']);

        if(HobbyModel::addHobby($name)){
            $this->addMessageSuccess("Ajout réussi");
            $this->addData("id",HobbyModel::getIDByName($name));
        }else{
            $this->addMessageError("Le nom existe déjà");
        }
    }

    private function deleteUserHobby(){
        $idUser = $this->currentUser['iduser'];
        $idHobby = isset($_POST['idHobby']) && !empty($_POST['idHobby']) ? $_POST['idHobby'] : null;
        if(HobbyModel::deleteUserHobby($idUser, $idHobby)){
            $this->addMessageSuccess('Le hobby a été supprimé');
        }else{
            $this->addMessageError('Erreur BD');
        }
    }

    private function addUserHobby(){
        $idUser = $this->currentUser['iduser'];
        $idHobby = isset($_POST['idHobby']) && !empty($_POST['idHobby']) ? $_POST['idHobby'] : null;
        if(HobbyModel::addUserHobby($idUser, $idHobby)){
            $this->addMessageSuccess('Le hobby a été ajouté');
        }else{
            $this->addMessageError('Erreur BD');
        }
    }
}

?>
