<?php
if(!defined('CONST_INCLUDE'))
	die('Acces direct interdit !'); 

class IdeaRequest extends RequestService{
    
    private $currentUser;
	public function __construct() {
        parent::__construct();
        $this->currentUser = AuthService::getCurrentUser();
    }	

    public function execute($action){
        switch($action){
            case "add":
                $this->addIdea();
            break;
            case "delete":
                $this->deleteIdea();
            break;
        }
    }
    
    private function addIdea(){
        $idUser = $this->currentUser['iduser'];
        $message = htmlspecialchars($_POST['message']);
        if(IdeaModel::addIdea($idUser, $message)){
            $this->addMessageSuccess("Ajout réussi");
        }else{
            $this->addMessageError("Erreur BD");
        }
    }

    private function deleteIdea(){
        $idIdea = htmlspecialchars($_POST['id']);

        if(IdeaModel::deleteIdea($idIdea)){
            $this->addMessageSuccess("Ajout réussi");
        }else{
            $this->addMessageError("Erreur BD");
        }
    }

}

?>
