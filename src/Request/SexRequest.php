<?php
if(!defined('CONST_INCLUDE'))
	die('Acces direct interdit !'); 

class SexRequest extends RequestService{
    
	public function __construct() {
        parent::__construct();
    }	

    public function execute($action){
        switch($action){
            case "addsex":
                $this->addSex();
            break;
            case "delete":
                $this->delete();
            break;
        }
    }    

    private function delete(){
        $sex = htmlspecialchars($_POST['sex']);

        if(SexModel::deleteSex($sex)){
            $this->addMessageSuccess("Ajout réussi");
        }else{
            $this->addMessageError("Erreur BD");
        }
    }

    private function addSex(){
        $name = htmlspecialchars($_POST['name']);

        if(SexModel::addSex($name)){
            $this->addMessageSuccess("Ajout réussi");
        }else{
            $this->addMessageError("Le nom existe déjà");
        }
    }

}

?>
