<?php

class PersonalityModel extends DBConnection{
    public function __construct () {
    }

    public static function getUserPersonalities($idUser){
        $req = self::$pdo->prepare("select * from PersonalityDish p inner join looklike on p.idDish = looklike.idDish where idUser = ?");
        $req->execute(array($idUser));
        return $req->fetchAll();
    }

    public static function getAllPersonalities(){
        $req = self::$pdo->prepare("select * from PersonalityDish");
        $req->execute();
        return $req->fetchAll();
    }

    public static function getUnusedPersonalities($idUser){
        $req = self::$pdo->prepare("select * from personalitydish where iddish not in (select iddish from looklike where iduser = ?) order by name");
        $req->execute(array($idUser));
        return $req->fetchAll(); 
    }

    public static function addUserPersonality($idUser, $idDish){
        $req = self::$pdo->prepare("insert into looklike values(?,?)");
        return $req->execute(array($idUser, $idDish));
    }

    public static function deleteUserPersonality($idUser, $idDish){
        $req = self::$pdo->prepare("delete from looklike where idUser = ? and idDish = ?");
        return $req->execute(array($idUser, $idDish)); 
    }

    public static function deletePersonality($idDish){
        $req = self::$pdo->prepare("delete from personalitydish where idDish = ?");
        return $req->execute(array($idDish)); 
    }

    public static function getUrlbyId($idDish){
        $req = self::$pdo->prepare("select iconURL from personalitydish where iddish=?");
        $req->execute(array($iddish));
        return $req->fetch(PDO::FETCH_COLUMN);
    }

    public static function addPersonality($name, $fileName){
        $req = self::$pdo->prepare("insert into personalitydish values(default,?,?)");
        return $req->execute(array($name, $fileName));
    }

    public static function getIDByName($name){
        $req = self::$pdo->prepare("select iddish from personalitydish where name=?");
        $req->execute(array($name));
        return $req->fetch(PDO::FETCH_COLUMN);
    }


}
?>