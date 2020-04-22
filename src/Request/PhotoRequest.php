<?php

if(!defined('CONST_INCLUDE'))
	die('Acces direct interdit !'); 

class PhotoRequest extends RequestService{
    
    private $valid_extensions = array("image/png"=>"png" , "image/jpg"=>"jpg" , "image/jpeg"=>"jpeg", "image/gif"=>"gif");
    private $maxSize = 5 * 1024 * 1024; //5Mo
    
	public function __construct() {
        parent::__construct();
    }

    public function execute($action){
        switch($action){
            case 'add':
                $this->uploadPhoto();
            break;
            case 'delete':
                $this->deletePhoto();
            break;
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

    private function deletePhoto(){
        $url = isset($_POST['url']) && !empty($_POST['url']) ? $_POST['url']:null;
        if(PhotoModel::deletePhoto($url)){
            $this->addMessageSuccess('La suppression a été réussi');
            unlink('./'.$url);
            //if there are no more file, delete the directory
            $directory = './'.dirname($url);
            if($this->dir_is_empty($directory)){
                rmdir($directory);
            }

        }else{
           $this->addMessageError('Erreur BD');
       }
    }

    private function uploadPhoto(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(isset($_FILES['file'])){
                $filename = $_FILES["file"]["name"];
                $filetype = $_FILES["file"]["type"];
                $filesize = $_FILES["file"]["size"];
                $uploadOk = true;
                
                //CHECK TYPE FILE
                if(!array_key_exists($filetype, $this->valid_extensions)){
                    $this->addMessageError('Veuillez sélectionner un format de fichier valide (.jpg, .jpeg, .gif ou .png)');
                    $uploadOk = false;
                }

                //CHECK SIZE
                if($filesize > $this->maxSize){
                    $this->addMessageError('La taille du fichier doit etre inférieur à 5Mo');
                    $uploadOk = false;
                }

                if ($uploadOk){ 

                    $user = AuthService::getCurrentUser();
                    $ext = $this->valid_extensions[$filetype];

                    $firstPhoto = false;
                    //CHECK IF DIRECTORY EXISTS
                    $directory = '.' . PATH_USER_PHOTO . $user['uniqid'];
                    if(!file_exists($directory)){
                        mkdir($directory);
                        $firstPhoto = true;
                    }

                    //CHECK IF NEW FILE EXISTS
                    do{
                        $target_file = $directory .'/'. uniqid(rand(), false) . '.' . $ext;
                    } while(file_exists($target_file));

                    if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
                        $successBD = PhotoModel::addPhoto($user['iduser'],substr($target_file,1), $firstPhoto);
                        if(!$successBD){
                            $this->addMessageError('Erreur BD');
                        }else{
                            $this->addMessageSuccess('Le fichier a été téléchargé');
                            $this->addData(substr($target_file,1));
                        }
                    } else {
                        $this->addMessageError('Erreur lors du téléchargement, veuillez réessayer');
                    }
                }
            }else{
                $this->addMessageError('Pas de fichier reçu');  
            }
        }else{
            $this->addMessageError('Pas la bonne requete');   
        }
    }

   
}


?>