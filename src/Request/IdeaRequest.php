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
            case "remove":
                $this->removeIdea();
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

}

?>
