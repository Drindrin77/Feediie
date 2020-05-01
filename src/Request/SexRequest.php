<?php
if(!defined('CONST_INCLUDE'))
	die('Acces direct interdit !'); 

class SexRequest extends RequestService{
    
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
        $sex = htmlspecialchars($_POST['sex']);

        if(SexModel::deleteSex($sex)){
            $this->addMessageSuccess("Ajout réussi");
        }else{
            $this->addMessageError("Erreur BD");
        }
    }

}

?>
