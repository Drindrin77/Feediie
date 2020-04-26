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
            case "add":
                $this->addHobby();
            break;
            case "remove":
                $this->removeHobby();
            break;
        }
    }    

    private function removeHobby(){
        $idUser = $this->currentUser['iduser'];
        $idHobby = isset($_POST['idHobby']) && !empty($_POST['idHobby']) ? $_POST['idHobby'] : null;
        if(HobbyModel::removeHobby($idUser, $idHobby)){
            $this->addMessageSuccess('Le hobby a été supprimé');
        }else{
            $this->addMessageError('Erreur BD');
        }
    }

    private function addHobby(){
        $idUser = $this->currentUser['iduser'];
        $idHobby = isset($_POST['idHobby']) && !empty($_POST['idHobby']) ? $_POST['idHobby'] : null;
        if(HobbyModel::addHobby($idUser, $idHobby)){
            $this->addMessageSuccess('Le hobby a été ajouté');
        }else{
            $this->addMessageError('Erreur BD');
        }
    }
}

?>
