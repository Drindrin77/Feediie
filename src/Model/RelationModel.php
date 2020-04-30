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
        return $req->execute($idRelation);
    }

}

?>
 