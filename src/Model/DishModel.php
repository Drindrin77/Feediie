<?php

class DishModel extends DBConnection{
    public function __construct () {
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

    public static function addUserFavorite($idUser, $idDish){
        $req = self::$pdo->prepare("insert into likeeat values(?,?)");
        return $req->execute(array($idUser, $idDish));         
    }

    public static function deleteUserFavorite($idUser, $idDish){
        $req = self::$pdo->prepare("delete from likeeat where idUser = ? and idDish = ?");
        return $req->execute(array($idUser, $idDish)); 
    }
    public static function getUserFavoriteDish($idUser){
        $req = self::$pdo->prepare("select * from likeeat where idUser = ?");
        $req->execute(array($idUser));
        return $req->fetchAll();
    }

    public static function deleteDish($idDish){
        $req = self::$pdo->prepare("delete from dish where idDish = ?");
        return $req->execute(array($idDish)); 
    }

    public static function getUrlbyId($idDish){
        $req = self::$pdo->prepare("select iconURL from dish where iddish=?");
        $req->execute(array($idDish));
        return $req->fetch(PDO::FETCH_COLUMN);
    }

    public static function addDish($name, $fileName){
        $req = self::$pdo->prepare("insert into dish values(default,?,?)");
        return $req->execute(array($name, $fileName));
    }

    public static function getIDByName($name){
        $req = self::$pdo->prepare("select iddish from dish where name=?");
        $req->execute(array($name));
        return $req->fetch(PDO::FETCH_COLUMN);
    }
}
?>