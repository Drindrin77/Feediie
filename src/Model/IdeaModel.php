<?php

class IdeaModel extends DBConnection{
    public function __construct () {
    }

    public static function addIdea($idUser, $message) {
        $req = self::$pdo->prepare("insert into idea values(default, ?,?)");
        return $req->execute(array($idUser, $message)); 
    }

    public static function removeIdea($idIdea) {
        $req = self::$pdo->prepare("delete from idea where idIdea = ?");
        return $req->execute(array($idIdea)); 
    }

    public static function getAllIdea(){
        $req = self::$pdo->prepare("select idIdea, firstname, message from idea inner join feediieuser on idea.iduser = feediieuser.iduser");
        $req->execute();
        return $req->fetchAll();
    }
}

?>