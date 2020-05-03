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
        $base64 = htmlspecialchars($_POST['base64Img']);
        $description = htmlspecialchars($_POST['description']);
        $ext = htmlspecialchars($_POST['ext']);

        $fileName = PhotoService::createFilename(PATH_RELATION_PHOTO,$ext);

        if(RelationModel::addRelationType(substr($fileName,1),$name,$description)){
            $this->addMessageSuccess("Ajout reussi");
            $id = RelationModel::getIDByName($name);
            PhotoService::base64ToFile($base64, $fileName);
            $this->addData('id',$id);
            $this->addData('url',$fileName);
        }else{
            $this->addMessageError("Le nom est déjà pris");
        }
    }

    private function deleteRelation(){
        $idRelation = htmlspecialchars($_POST['id']);
        $url = RelationModel::getUrlByID($idRelation);
        if(RelationModel::deleteRelationType($idRelation)){
            PhotoService::deletePhoto($url);
            $this->addMessageSuccess("Suppression réussi");
        }else{
            $this->addMessageError("Erreur BD");
        }
    }

}

?>
