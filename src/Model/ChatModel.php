<?php
if(!defined('CONST_INCLUDE'))
    die('Acces direct interdit !');

class ChatModel extends DBConnection{

    public function __construct () {
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
/*
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
*/
    public static function addMessage($userId, $contactId, $message){

        $req = self::$pdo->prepare("INSERT INTO contact (idAuthor, idRecipient, message, dateMessage) 
                                    VALUES (?, ?, ?, CURRENT_TIMESTAMP)                   
                                   ");
        return $req->execute(array($userId, $contactId, $message));
    }

    /**
     * @param $userId l'id de l'utilisateur courrant
     * @param $contactId l'id du destinataire
     * @return mixed un tableau contenant la liste des messages ayant étés lus
     */
    public static function readMessages($userId, $contactId){
        $req = self::$pdo->prepare("
                                    WITH updatedMessages as (UPDATE
                                        contact 
                                    SET
                                        isread = TRUE
                                    WHERE
                                        idAuthor = ?
                                        AND idRecipient = ?
                                        AND isread = FALSE
                                        
                                    RETURNING *)
                                    SELECT message, datemessage, author.uniqid
                                    FROM 
                                    updatedMessages
                                    INNER JOIN feediieuser AS author ON author.iduser = updatedMessages.idAuthor
                                    ORDER BY idMessage DESC ;
                                    ");
        $req->execute(array($contactId, $userId));
        return $req->fetchAll();
    }

}