<?php
if(!defined('CONST_INCLUDE'))
	die('Acces direct interdit !'); 

class DietRequest extends RequestService{

    private $currentUser;

	public function __construct() {
        parent::__construct();
        $this->currentUser = AuthService::getCurrentUser();
    }	

    public function execute($action){
        switch($action){
            case "adddiet":
                $this->addDiet();
            break;
            case "deletediet":
                $this->deleteDiet();
            break;
            case "deleteuserdiet":
                $this->deleteUserDiet();
            break;
            case "adduserdiet":
                $this->addUserDiet();
            break;
        }
    }    

    private function addUserDiet(){
        $idDiet = htmlspecialchars($_POST['idDiet']);
        $idUser = $this->currentUser['iduser'];

        if(DietModel::addUserDiet($idUser,$idDiet)){
            $this->addMessageSuccess("Ajout reussi");
        }else{
            $this->addMessageError("Erreur BD");
        }
    }

    private function deleteUserDiet(){
        $idDiet = htmlspecialchars($_POST['idDiet']);
        $idUser = $this->currentUser['iduser'];
        if(DietModel::deleteUserDiet($idUser,$idDiet)){
            $this->addMessageSuccess("Supression reussi");
        }else{
            $this->addMessageError("Erreur BD");
        }
    }

    private function addDiet(){
        // $name = htmlspecialchars($_POST['name']);
        // $zipcode = htmlspecialchars($_POST['zipcode']);

        // if(CityModel::addCity($name, $zipcode)){
        //     $this->addMessageSuccess("Ajout reussi");
        // }else{
        //     $this->addMessageError("Erreur BD");
        // }
    }

    private function deleteDiet(){
        $idDiet = htmlspecialchars($_POST['idDiet']);
        if(DietModel::deleteDiet($idDiet)){
            $this->addMessageSuccess("Supression reussi");
        }else{
            $this->addMessageError("Erreur BD");
        }
    }

}

?>
