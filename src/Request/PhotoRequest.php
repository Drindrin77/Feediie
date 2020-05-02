<?php

if(!defined('CONST_INCLUDE'))
	die('Acces direct interdit !'); 

class PhotoRequest extends RequestService{
    
    private $user;
    private $valid_extensions = array("image/png"=>"png" , "image/jpg"=>"jpg" , "image/jpeg"=>"jpeg", "image/gif"=>"gif");
    private $maxSize = 5 * 1024 * 1024; //5Mo
    
	public function __construct() {
        parent::__construct();
        $this->user = AuthService::getCurrentUser();
    }

    public function execute($action){
        switch($action){
            case 'add':
                $this->uploadUserPhoto();
            break;
            case 'delete':
                $this->deleteUserPhoto();
            break;
            case 'setpriority':
                $this->setPriority();
            break;
            case 'gettemporaryphoto':
                $this->returnTemporaryPhoto();
            break;
        }
    }

    //RETURN EXTENSION AND BASE64IMG
    private function returnTemporaryPhoto(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(isset($_FILES['file'])){
                $ext = PhotoService::getExtension($_FILES['file']['name']);
                $base64 = PhotoService::createBase64Photo($_FILES['file']['tmp_name'],$ext);
                $this->addData('imgSrc',sprintf('%s', $base64));
                $this->addData('extension',$ext);
            }
        }
    }

    private function setPriority(){
        $url = htmlspecialchars($_POST['url']);
        $idUser = $this->user['iduser'];
        PhotoModel::setPriorityToFalse($idUser);
        PhotoModel::setNewPriority($url);
        $this->addMessageSuccess('La priorite a été changé');
    }

    private function deleteUserPhoto(){
        $priority = isset($_POST['priority']) && !empty($_POST['priority']) ? $_POST['priority']:null;
        $priority = $priority == 'false' ? false:true;
        $url = isset($_POST['url']) && !empty($_POST['url']) ? $_POST['url']:null;

        if(PhotoModel::deleteUserPhoto($url)){
            $this->addMessageSuccess('La suppression a été réussi');
            PhotoService::deletePhoto($url);

            //if there are no more file, delete the directory
            $directory = './'.dirname($url);
            if($this->dir_is_empty($directory)){
                rmdir($directory);
            }
            //If photo was priority and there are another photos, delegate it to the first one
            else if($priority){
                PhotoModel::setPriorityToFirst($this->user['iduser']);
                $this->addData('newPriorityUrl',PhotoModel::getPriorityPhoto($this->user['iduser']));
            }

        }else{
           $this->addMessageError('Erreur BD');
       }
    }


    private function dir_is_empty($dir) {
        $handle = opendir($dir);
        while (false !== ($entry = readdir($handle))) {
          if ($entry != "." && $entry != "..") {
            closedir($handle);
            return FALSE;
          }
        }
        closedir($handle);
        return TRUE;
    }


    private function uploadUserPhoto(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(isset($_FILES['file'])){
                $uploadOk = true;
                
                //CHECK TYPE FILE
                if(!PhotoService::validExtension($_FILES["file"]["type"])){
                    $this->addMessageError('Veuillez sélectionner un format de fichier valide (.jpg, .jpeg, .gif ou .png)');
                    $uploadOk = false;
                }

                //CHECK SIZE
                if(!PhotoService::validSize($_FILES["file"]["size"])){
                    $this->addMessageError('La taille du fichier doit etre inférieur à 5Mo');
                    $uploadOk = false;
                }

                if ($uploadOk){ 

                    $ext = PhotoService::getExtByFileType($_FILES["file"]["type"]);

                    $firstPhoto = false;
                    //CHECK IF DIRECTORY EXISTS
                    $directory = '.' . PATH_USER_PHOTO . $this->user['uniqid'];
                    if(!file_exists($directory)){
                        mkdir($directory);
                        $firstPhoto = true;
                    }

                    $target_file = PhotoService::createUserFilename($this->user['uniqid'], $ext);
                    $successBD = PhotoModel::addPhoto($this->user['iduser'],substr($target_file,1), $firstPhoto);

                    if($successBD){
                        PhotoService::moveTmpFile($_FILES['file']['tmp_name'], $target_file);
                        $this->addMessageSuccess('Le fichier a été téléchargé');
                        $this->addData('url',substr($target_file,1));
                        $this->addData('priority',$firstPhoto);
                        
                    }else{
                        $this->addMessageError('Erreur BD');
                    }
                }
            }
        }  

    }


   
}


?>