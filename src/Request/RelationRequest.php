<?php
if(!defined('CONST_INCLUDE'))
	die('Acces direct interdit !'); 

class RelationRequest extends RequestService{
    
	public function __construct() {
        parent::__construct();
    }	

    public function execute($action){
        switch($action){
            case "add":
                $this->add();
            break;
            case "delete":
                $this->delete();
            break;
        }
    }    

    private function delete(){
        $idRelation = htmlspecialchars($_POST['id']);

        if(RelationModel::deleteRelationType($idRelation)){
            $this->addMessageSuccess("Ajout réussi");
        }else{
            $this->addMessageError("Erreur BD");
        }
    }

}

?>
