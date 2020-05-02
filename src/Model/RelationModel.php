<?php

class RelationModel extends DBConnection{
    public function __construct () {
    }

    public static function getAllRelationType(){
        $req = self::$pdo->prepare("select * from RelationType");
        $req->execute();
        return $req->fetchAll();
    }

    public static function deleteRelationType($idRelation){
        $req = self::$pdo->prepare("delete from RelationType where idRelationType=?");
        return $req->execute(array($idRelation));
    }

    public static function addRelationType($pathIcon, $name){
        $req = self::$pdo->prepare("insert into RelationType values (default, ?, ?)");
        return $req->execute(array($pathIcon,$name)); //FALSE => UNIQUE
    }

    public static function getIDByName($name){
        $req = self::$pdo->prepare("select idrelationtype from RelationType where name=?");
        $req->execute(array($name));
        return $req->fetch(PDO::FETCH_COLUMN);
    }

}

?>