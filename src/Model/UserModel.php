<?php

if(!defined('CONST_INCLUDE'))
    die('Acces direct interdit !');

class UserModel extends DBConnection{
   public function __construct () {
   }

    public static function deleteUser($idUser){
        $req = self::$pdo->prepare("delete from feediieuser where iduser = ?");
        return $req->execute(array($idUser));
    }

    public static function findByToken($token){
        $req = self::$pdo->prepare("select idUser,password, isadmin, uniqid, birthday, firstName, description, email, city.name as city, city.zipcode as zipcode, nbReport, sex.name as sex
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

    public static function fetchMessages($userUniqId, $contactUniqId, $offset){
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
                                    
                                    ORDER BY idmessage DESC
                                    LIMIT 50
                                    OFFSET ?");

        $req->execute(array($userUniqId, $contactUniqId, $contactUniqId, $userUniqId, $offset));
        return $req->fetchAll();
    }

    public static function fetchUnreadMessages($userId, $contactId){
        $req = self::$pdo->prepare("SELECT
                                        message,
                                        author.uniqid,
                                        datemessage
                                    FROM
                                        contact
                                        INNER JOIN feediieUser author ON author.iduser = ?
                                    WHERE
                                        idAuthor = ? 
                                        AND idRecipient = ?
                                        AND isread = FALSE
                                    ORDER BY idmessage DESC
                                   ");

        $req->execute(array($contactId, $contactId, $userId));
        return $req->fetchAll();
    }

    public static function addMessage($userId, $contactId, $message){

        $req = self::$pdo->prepare("INSERT INTO contact (idAuthor, idRecipient, message, dateMessage) 
                                    VALUES (?, ?, ?, CURRENT_TIMESTAMP)                   
                                   ");
        return $req->execute(array($userId, $contactId, $message));
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
    public static function setFilterParameter($firstName, $email, $password, $birthday, $sex, $city, $uniqID, $token){
        $req = self::$pdo->prepare("select idUser from");
        $res = $req->execute(array($uniqID, $firstName, $birthday, $email, $password, $token, $city, $sex));
        return $res;
    }
}

?>