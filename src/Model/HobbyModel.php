<?php

class HobbyModel extends DBConnection{
    public function __construct () {
    }

    public static function getUserHobbies($idUser){
        $req = self::$pdo->prepare("select * from hobby inner join practice on hobby.idHobby = practice.idHobby where idUser = ? order by name");
        $req->execute(array($idUser));
        return $req->fetchAll();
    }

    public static function getAllHobies(){
        $req = self::$pdo->prepare("select * from hobby order by name");
        $req->execute();
        return $req->fetchAll(); 
    }

}

?>