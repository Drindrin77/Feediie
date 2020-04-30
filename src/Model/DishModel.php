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

    public static function addFavorite($idUser, $idDish){
        $req = self::$pdo->prepare("insert into likeeat values(?,?)");
        return $req->execute(array($idUser, $idDish));         
    }

    public static function deleteFavorite($idUser, $idDish){
        $req = self::$pdo->prepare("delete from likeeat where idUser = ? and idDish = ?");
        return $req->execute(array($idUser, $idDish)); 
    }
}
?>