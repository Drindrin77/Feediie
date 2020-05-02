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


    public static function addUserHobby($idUser, $idHobby) {
        $req = self::$pdo->prepare("insert into practice values(?,?)");
        return $req->execute(array($idUser, $idHobby)); 
    }

    public static function deleteUserHobby($idUser, $idHobby) {
        $req = self::$pdo->prepare("delete from practice where idUser = ? and idHobby = ?");
        return $req->execute(array($idUser, $idHobby)); 
    }

    public static function deleteHobby($idHobby){
        $req = self::$pdo->prepare("delete from hobby where idHobby = ?");
        return $req->execute(array($idHobby)); 
    }

    public static function addHobby($name){
        $req = self::$pdo->prepare("insert into hobby values (default, ?)");
        return $req->execute(array($name)); 
    }

    public static function getIDByName($name){
        $req = self::$pdo->prepare("select idhobby from hobby where name=?");
        $req->execute(array($name));
        return $req->fetch(PDO::FETCH_COLUMN);
    }

}

?>