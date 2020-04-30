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

    public static function addPersonality($idUser, $idDish){
        $req = self::$pdo->prepare("insert into looklike values(?,?)");
        return $req->execute(array($idUser, $idDish));
    }

    public static function deletePersonality($idUser, $idDish){
        $req = self::$pdo->prepare("delete from looklike where idUser = ? and idDish = ?");
        return $req->execute(array($idUser, $idDish)); 
    }


}
?>