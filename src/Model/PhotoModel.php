<?php

class PhotoModel extends DBConnection{
    public function __construct () {
    }

    public static function getAllPhotos($idUser){
        $req = self::$pdo->prepare("select * from photo where iduser = ?");
        $req->execute(array($idUser));
        return $req->fetchAll();
    }

    public static function getPriorityPhoto($idUser){
        $req = self::$pdo->prepare("select * from photo where iduser = ? and priority=true");
        $req->execute(array($idUser));
        return $req->fetch();
    }

    public static function addPhoto($idUser, $path, $priority=false){
        $req = self::$pdo->prepare("insert into photo values(default, ?, ?, ?)");
        $priority = $priority ? 'true':'false';
        return $req->execute(array($path,$priority,$idUser));
    }

    public static function deletePhoto($url){
        $req = self::$pdo->prepare("delete from photo where url=?");
        return $req->execute(array($url));
    }

}


?>