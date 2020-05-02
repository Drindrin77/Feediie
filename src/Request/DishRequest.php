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
            case "deleteuserfavorite":
                $this->deleteUserFavorite();
            break;
            case "adduserfavorite":
                $this->addUserFavorite();
            break;
            case "deletedish":
                $this->deleteDish();
            break;
            case "adddish":
                $this->addDish();
            break;
        }
    }    

    // GENERAL DISHES

    private function addDish(){
        $name = htmlspecialchars($_POST['name']);
        $base64 = htmlspecialchars($_POST['base64Img']);
        $ext = htmlspecialchars($_POST['ext']);
        $fileName = PhotoService::createFilename(PATH_DISH_PHOTO,$ext);

        if(DishModel::addDish($name, $fileName)){
            $this->addMessageSuccess("Ajout reussi");
            $id = DishModel::getIDByName($name);
            PhotoService::base64ToFile($base64, $fileName);
            $this->addData('id',$id);
            $this->addData('url',$fileName);
        }else{
            $this->addMessageError("Le nom est déjà pris");
        }   
    }

    private function deleteDish(){
        $idDish = htmlspecialchars($_POST['idDish']);
        if(DishModel::deleteDish($idDish)){
            $this->addMessageSuccess("Suppression reussi");
        }else{
            $this->addMessageError("Erreur BD");
        }
    }

    // USER DISHES

    private function addUserFavorite(){
        $idDish = htmlspecialchars($_POST['idDish']);
        $idUser = $this->currentUser['iduser'];
        if(DishModel::addUserFavorite($idUser, $idDish)){
            $this->addMessageSuccess("Ajout reussi");
        }else{
            $this->addMessageError("Erreur BD");
        }
    }

    private function deleteUserFavorite(){
        $idDish = htmlspecialchars($_POST['idDish']);
        $idUser = $this->currentUser['iduser'];
        if(DishModel::deleteUserFavorite($idUser, $idDish)){
            $this->addMessageSuccess("Supression reussi");
        }else{
            $this->addMessageError("Erreur BD");
        }
    }
}

?>
