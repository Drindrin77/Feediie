<?php
if(!defined('CONST_INCLUDE'))
	die('Acces direct interdit !'); 

class RelationRequest extends RequestService{
    
	public function __construct() {
        parent::__construct();
    }	

    public function execute($action){
        switch($action){
            case "addrelation":
                $this->addRelation();
            break;
            case "deleterelation":
                $this->deleteRelation();
            break;
        }
    }    

    private function addRelation(){
        $name = htmlspecialchars($_POST['name']);
        $path = '';
        //TODO ADD PATH
        if(RelationModel::addRelationType($path, $name)){
            $this->addMessageSuccess("Ajout réussi");
            $this->addData("id",RelationModel::getIDByName($name));
        }else{
            $this->addMessageError("Le nom existe déjà");
        }
    }

    private function deleteRelation(){
        $idRelation = htmlspecialchars($_POST['id']);

        if(RelationModel::deleteRelationType($idRelation)){
            $this->addMessageSuccess("Ajout réussi");
        }else{
            $this->addMessageError("Erreur BD");
        }
    }

}

?>
