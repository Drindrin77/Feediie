<?php

class PhotoModel extends DBConnection{
    public function __construct () {
    }

    public static function getAllPhotos($idUser){
        $req = self::$pdo->prepare("select * from photo where iduser = ?");
        $req->execute(array($idUser));
        return $req->fetchAll();
    }

}


?>