<?php
if(!defined('CONST_INCLUDE'))
	die('Acces direct interdit !'); 

class CityRequest extends RequestService{
    
	public function __construct() {
        parent::__construct();
    }	

    public function execute($action){
        switch($action){
            case "addcity":
                $this->addCity();
            break;
            case "deletecity":
                $this->deleteCity();
            break;
        }
    }    


    private function addCity(){
        $name = htmlspecialchars($_POST['name']);
        $zipcode = htmlspecialchars($_POST['zipcode']);

        if(CityModel::addCity($name, $zipcode)){
            $id = CityModel::getID($name, $zipcode);
            $this->addMessageSuccess("Ajout reussi");
            $this->addData('id',$id);
        }else{
            $this->addMessageError("Existe deja");
        }
    }

    private function deleteCity(){
        $idCity = htmlspecialchars($_POST['idCity']);
        if(CityModel::deleteCity($idCity)){
            $this->addMessageSuccess("Supression reussi");
        }else{
            $this->addMessageError("Erreur BD");
        }
    }

}

?>
