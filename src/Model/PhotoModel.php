<?php

class PhotoModel extends DBConnection{
    public function __construct () {
    }

    public static function getAllPhotos($idUser){
        $req = self::$pdo->prepare("select * from photo where iduser = ? order by idphoto");
        $req->execute(array($idUser));
        return $req->fetchAll();
    }

    public static function getPriorityPhoto($idUser){
        $req = self::$pdo->prepare("select url from photo where iduser = ? and priority=true");
        $req->execute(array($idUser));
        $result = $req->fetch();
        if(empty($result))
            $result = PATH_DEFAULT_USER_PHOTO;
        return $result;
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

    public static function setPriorityToFirst($iduser){
        $req = self::$pdo->prepare("update photo set priority=true where idphoto in (select idphoto from photo where iduser=? and priority=false order by idphoto limit 1)");
        return $req->execute(array($iduser));
    }

    public static function setPriorityToFalse($iduser){
        $req = self::$pdo->prepare("update photo set priority=false where iduser=? and priority=true");
        return $req->execute(array($iduser));
    }

    public static function setNewPriority($url){
        $req = self::$pdo->prepare("update photo set priority=true where url = ?");
        return $req->execute(array($url));

    }

    

}


?>