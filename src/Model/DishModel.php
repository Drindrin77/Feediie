<?php

class DishModel extends DBConnection{
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


    public static function getUserFavoritesDishes($idUser){
        $req = self::$pdo->prepare("select * from Dish inner join likeEat on Dish.idDish = likeEat.idDish where idUser = ?");
        $req->execute(array($idUser));
        return $req->fetchAll();
    }

    public static function getUnusedDishes($idUser){
        $req = self::$pdo->prepare("select * from Dish where iddish not in (select iddish from likeeat where iduser = ?) order by name");
        $req->execute(array($idUser));
        return $req->fetchAll();
    }

    public static function getAllDishes(){
        $req = self::$pdo->prepare("select * from Dish");
        $req->execute();
        return $req->fetchAll();
    }

    public static function getAllRelationType(){
        $req = self::$pdo->prepare("select * from RelationType");
        $req->execute();
        return $req->fetchAll();
    }

    public static function addFavorite($idUser, $idDish){
        $req = self::$pdo->prepare("insert into likeeat values(?,?)");
        return $req->execute(array($idUser, $idDish));         
    }

    public static function deleteFavorite($idUser, $idDish){
        $req = self::$pdo->prepare("delete from likeeat where idUser = ? and idDish = ?");
        return $req->execute(array($idUser, $idDish)); 
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