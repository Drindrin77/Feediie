<?php

if(!defined('CONST_INCLUDE'))
    die('Acces direct interdit !');

class UserModel extends DBConnection{
   public function __construct () {
   }

    public static function promuteAdmin($idUser){
        $req = self::$pdo->prepare("update feediieuser set isadmin = true where iduser = ?");
        return $req->execute(array($idUser));
    }

    public static function destituteAdmin($idUser){
        $req = self::$pdo->prepare("update feediieuser set isadmin = false where iduser = ?");
        return $req->execute(array($idUser));
    }


    public static function deleteUser($idUser){
        $req = self::$pdo->prepare("delete from feediieuser where iduser = ?");
        return $req->execute(array($idUser));
    }

    public static function findByToken($token){
        $req = self::$pdo->prepare("select idUser,password, sex, isadmin, uniqid, birthday, firstName, description, email, city.name as city, city.zipcode as zipcode, nbReport 
        from feediieuser left join city on city.idCity = feediieuser.idCity where token=?");
        $req->execute(array($token));
        return $req->fetch();
    }

    public static function verifyUserExist($email, $password){
        $req = self::$pdo->prepare("select * from feediieuser where email = ? and password = ?");
        $req->execute(array($email, $password));
    }

    public static function resetPassword($encodedNewPassword){
        $req = self::$pdo->prepare("update feediieuser set password = ? where iduser = ?");
        $req->execute(array($encodedNewPassword, AuthService::getCurrentUser()['iduser'])); 
    }

    public static function getUserByUniqID($uniqID){
        $req = self::$pdo->prepare("select idUser, firstName, sex, DATE_PART('year', now()::date) - DATE_PART('year', birthday::date) as age
                                                    , description, isAdmin, city.name as city, city.zipcode as zipcode, nbReport
                                                    from feediieuser left join city on city.idCity = feediieuser.idCity where uniqID=?");
        $req->execute(array($uniqID)); 
        return $req->fetch();
    }

    public static function filterUsersSwipe($idUser){
        $req = self::$pdo->prepare("SELECT u2.idUser, u2.firstname FROM FeediieUser u1, FeediieUser u2 WHERE 
                                            u1.iduser <> u2.iduser and 
                                            u1.sex IN (SELECT sex from interestedsex WHERE iduser = u2.iduser) and 
                                            u2.sex IN (SELECT sex from interestedsex WHERE iduser = u1.iduser) and
                                            (SELECT DATE_PART('year', now()::date) - DATE_PART('year', u1.birthday::date)) between u2.filteragemin and u2.filteragemax and 
                                            (SELECT DATE_PART('year', now()::date) - DATE_PART('year', u2.birthday::date)) between u1.filteragemin and u1.filteragemax and
                                            (SELECT iddiet from interesteddiet WHERE iduser=u1.iduser) IN (SELECT iddiet FROM followDiet WHERE iduser=u2.iduser) and
                                            (SELECT iddiet from interesteddiet WHERE iduser=u2.iduser) IN (SELECT iddiet FROM followDiet WHERE iduser=u1.iduser) and
                                            (SELECT idRelationType from interestedRelationType WHERE iduser=u1.iduser) IN (SELECT idRelationType FROM interestedRelationType where iduser=u2.iduser) and
                                            (SELECT idRelationType from interestedRelationType WHERE iduser=u2.iduser) IN (SELECT idRelationType FROM interestedRelationType where iduser=u1.iduser) and 
                                            u2.idUser not in (SELECT iduser_dislike from dislike WHERE iduser=u1.iduser) AND
                                            u2.idUser not in (SELECT iduser_liked from likedUser WHERE iduser=u1.iduser) AND
                                            u1.idUser <> ?");
        $req->execute(array($idUser));
        return $req->fetchAll();
    }

    public static function getAllUsers($idUser){
        $req = self::$pdo->prepare("select * from FeediieUser where idUser <> ?");
        $req->execute(array($idUser));
        return $req->fetchAll();
    }

    public static function getInfoUser($idUser){
        $req = self::$pdo->prepare("select * from FeediieUser where idUser = ?");
        $req->execute(array($idUser));
        return $req->fetchAll();
    }

    public static function getUserByMail($mail){
        $req = self::$pdo->prepare("select * from feediieuser where email = ?");
        $req->execute(array($mail));
        return $req->fetch();
    }

    public static function setToken($token, $mail){
        $req = self::$pdo->prepare("update feediieuser set token = ? where email = ?");
        $req->execute(array($token, $mail));
    }

    public static function getAllUserOrderReport($idUser){
        $req = self::$pdo->prepare("select iduser, isadmin, firstname, email, nbReport from FeediieUser where iduser<> ? order by nbreport desc");
        $req->execute(array($idUser));
        return $req->fetchAll();
    }



    public static function editInfo($args, $idUser){
        $sql = "update feediieuser set ";
        $values = array();
        foreach($args as $key => $value){
            $sql .= $key . " = ?,";
            array_push($values, $value);
        }
        $sql = substr($sql, 0, -1);
        $sql .= " where idUser = ?;";
        array_push($values, $idUser);
        $req = self::$pdo->prepare($sql);
        return $req->execute($values); 
    }
    
    public static function signUp($firstName, $email, $password, $birthday, $sex, $city, $uniqID, $token, $ageMin, $ageMax){
        $req = self::$pdo->prepare("insert into feediieuser (uniqID, firstName, birthday, email, password, filterAgeMin, filterAgeMax, token, idCity, sex) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $res = $req->execute(array($uniqID, $firstName, $birthday, $email, $password, $ageMin, $ageMax, $token, $city, $sex));
        return $res;
    }
    public static function setFilterParameter($firstName, $email, $password, $birthday, $sex, $city, $uniqID, $token){
        $req = self::$pdo->prepare("select idUser from");
        $res = $req->execute(array($uniqID, $firstName, $birthday, $email, $password, $token, $city, $sex));
        return $res;
    }
}

?>