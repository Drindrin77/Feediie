<?php

class IdeaModel extends DBConnection{
    public function __construct () {
    }

    public static function addIdea($idUser, $message) {
        $req = self::$pdo->prepare("insert into idea values(default, ?,?)");
        return $req->execute(array($idUser, $message)); 
    }

    public static function removeIdea($idUser) {
        $req = self::$pdo->prepare("delete from idea where idUser = ?");
        return $req->execute(array($idUser)); 
    }

    public static function getAllIdea(){
        $req = self::$pdo->prepare("select * from idea");
        return $req->execute(); 
    }


}

?>