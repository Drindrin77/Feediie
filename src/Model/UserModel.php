<?php

if(!defined('CONST_INCLUDE'))
    die('Acces direct interdit !');

class UserModel extends DBConnection{
   public function __construct () {
   }

    public static function findByToken($token){
        $req = self::$pdo->prepare("select idUser,password, isadmin, uniqid, birthday, firstName, description, city.name as city, city.zipcode as zipcode, nbReport, sex.name as sex
        from feediieuser, city, sex where city.idCity = feediieuser.idCity and sex.name = feediieuser.sex and token=?");
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
        $req = self::$pdo->prepare("select idUser, firstName, DATE_PART('year', now()::date) - DATE_PART('year', birthday::date) as age
                                                    , description, isAdmin, city.name as city, city.zipcode as zipcode, nbReport, sex.name as sex
                                    from feediieuser, city, sex where city.idCity = feediieuser.idCity and sex.name = feediieuser.sex and uniqID=?");
        $req->execute(array($uniqID)); 
        return $req->fetch();
    }

    //TODO DOUBLE FILTRAGE
   public static function getAllUser($idUser){
        $req = self::$pdo->prepare("select * from FeediieUser where idUser <> ?");
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


    public static function addHobby($idUser, $idHobby) {
        $req = self::$pdo->prepare("insert into practice values(?,?)");
        return $req->execute(array($idUser, $idHobby));
    }

    public static function removeHobby($idUser, $idHobby) {
        $req = self::$pdo->prepare("delete from practice where idUser = ? and idHobby = ?");
        return $req->execute(array($idUser, $idHobby));
    }

    public static function fetchMatchedUsers($uniqID){
        $req = self::$pdo->prepare("SELECT
                                        matchedUser.firstname AS name,
                                        EXTRACT(YEAR FROM(age(matchedUser.birthday))) AS age,
                                        to_char(likedU.dateMatch, 'DD/MM/YYYY') AS date_match,
                                        CASE WHEN photo IS NOT NULL THEN photo.url ELSE 'Images/UserUpload/default.png' END AS photo_url,
                                        matchedUser.uniqId AS uniq_id
                                    FROM
                                        feediieuser matchedUser 
                                    INNER JOIN likeduser likedU ON matchedUser.iduser = likedU.iduser_liked
                                    INNER JOIN feediieuser currentUser ON likedU.iduser = currentUser.iduser
                                    LEFT OUTER JOIN photo ON photo.idUser = matchedUser.idUser
                                    
                                    WHERE 
                                        matched = true
                                    AND currentUser.uniqid = ?
                                    AND (photo.priority = true OR photo IS NULL)
                                    
                                    ORDER BY 
	                                    likedU.datematch DESC");
        $req->execute(array($uniqID));
        return $req->fetchAll();
    }

    public static function fetchMessages($userUniqId, $contactUniqId){
        $req = self::$pdo->prepare("SELECT
                                        message,
                                        author.uniqid,
                                        datemessage
                                    
                                    FROM
                                        contact
                                    INNER JOIN feediieUser author ON idauthor = author.iduser
                                    INNER JOIN feediieUser recipient ON idrecipient = recipient.iduser
                                    
                                    WHERE
                                    (author.uniqId = ? AND recipient.uniqId = ?) OR (author.uniqId = ? AND recipient.uniqId = ?)
                                    
                                    ORDER BY idmessage");

        $req->execute(array($userUniqId, $contactUniqId, $contactUniqId, $userUniqId));
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

    public static function signUp($firstName, $email, $password, $birthday, $sex, $city, $uniqID, $token){
        $req = self::$pdo->prepare("insert into feediieuser VALUES (default, ? ,?, ?, ?, ?, null, 
        default, default, default, ?, default, ?, default, ?)");
        $res = $req->execute(array($uniqID, $firstName, $birthday, $email, $password, $token, $city, $sex));
        return $res;
    }
/*
    insert into feediieuser VALUES (default,'0bf7cf11709ce61b1861ab55e688d71e7b0bcc1cea0d66e9b6faed536947f583'
    ,null ,'Léanna', 'Ji', '1999-11-04', 'ji.leanna@outlook.com', '$2y$10$7Eag0hekMyCYm8gGBobdKebFoDcQhxAFsjxqC/ieh79TkEMzxElj6', null,
    default, default, default, default, '0bf7cf11709ce61b1861ab55e688d71e7b0bcc1cea0d66e9b6faed536947f583', default, 1, default, 'Femme')
  */

   /*public function getAllUser($idUser,$firstName,$birthDay,$description){
       $req = self::$pdo->prepare("select idUser,firstName,birthDay,description from FeediieUser");
       $req->execute(array($idUser,$firstName,$birthDay,$description));
    }*/
}

?>