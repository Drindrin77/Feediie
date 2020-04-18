<?php

class DishModel extends DBConnection{
    public function __construct () {
    }

    public static function getAllPersonnalities($idUser){
        $req = self::$pdo->prepare("select * from PersonalityDish p inner join looklike on p.idDish = looklike.idDish where idUser = ?");
        $req->execute(array($idUser));
        return $req->fetchAll();
    }



    public static function getAllFavoritesDishes($idUser){
        $req = self::$pdo->prepare("select * from Dish inner join likeEat on Dish.idDish = likeEat.idDish where idUser = ?");
        $req->execute(array($idUser));
        return $req->fetchAll();
    }
}
?>

