<?php

class HobbyModel extends DBConnection{
    public function __construct () {
    }

    public static function getUserHobbies($idUser){
        $req = self::$pdo->prepare("select * from hobby inner join practice on hobby.idHobby = practice.idHobby where idUser = ? order by name");
        $req->execute(array($idUser));
        return $req->fetchAll();
    }

    public static function getAllHobbies(){
        $req = self::$pdo->prepare("select * from hobby order by name");
        $req->execute();
        return $req->fetchAll(); 
    }

    public static function getUnpracticedHobbies($idUser){
        $req = self::$pdo->prepare("select * from hobby where idhobby not in (select idhobby from practice where iduser = ?) order by name");
        $req->execute(array($idUser));
        return $req->fetchAll(); 
    }


    public static function addHobby($idUser, $idHobby) {
        $req = self::$pdo->prepare("insert into practice values(?,?)");
        return $req->execute(array($idUser, $idHobby)); 
    }

    public static function removeHobby($idUser, $idHobby) {
        $req = self::$pdo->prepare("delete from practice where idUser = ? and idHobby = ?");
        return $req->execute(array($idUser, $idHobby)); 
    }


}

?>