<?php
if(!defined('CONST_INCLUDE'))
	die('Acces direct interdit !'); 

class DishRequest extends RequestService{
    
    private $currentUser;
	public function __construct() {
        parent::__construct();
        $this->currentUser = AuthService::getCurrentUser();
    }	

    public function execute($action){
        switch($action){
            case "deletepersonality":
                $this->deletePersonality();
            break;
            case "addpersonality":
                $this->addPersonality();
            break;
            case "deletefavorite":
                $this->deleteFavorite();
            break;
            case "addfavorite":
                $this->addFavorite();
            break;
        }
    }    

    private function addFavorite(){
        $idDish = htmlspecialchars($_POST['idDish']);
        $idUser = $this->currentUser['iduser'];
        if(DishModel::addFavorite($idUser, $idDish)){
            $this->addMessageSuccess("Ajout reussi");
        }else{
            $this->addMessageError("Erreur BD");
        }
    }

    private function deleteFavorite(){
        $idDish = htmlspecialchars($_POST['idDish']);
        $idUser = $this->currentUser['iduser'];
        if(DishModel::deleteFavorite($idUser, $idDish)){
            $this->addMessageSuccess("Supression reussi");
        }else{
            $this->addMessageError("Erreur BD");
        }
    }

    private function addPersonality(){
        $idDish = htmlspecialchars($_POST['idDish']);
        $idUser = $this->currentUser['iduser'];
        if(DishModel::addPersonality($idUser, $idDish)){
            $this->addMessageSuccess("Ajout reussi");
        }else{
            $this->addMessageError("Erreur BD");
        }
    }

    private function deletePersonality(){
        $idDish = htmlspecialchars($_POST['idDish']);
        $idUser = $this->currentUser['iduser'];
        if(DishModel::deletePersonality($idUser, $idDish)){
            $this->addMessageSuccess("Supression reussi");
        }else{
            $this->addMessageError("Erreur BD");
        }
    }

}

?>
