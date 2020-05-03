<?php
if (!defined('CONST_INCLUDE'))
    die('Acces direct interdit !');

class ChatModel extends DBConnection
{

    public function __construct()
    {
    }

    public static function fetchMatchedUsers($userId)
    {
        $req = self::$pdo->prepare("SELECT
                                      matchedUser.firstname AS name,
                                      EXTRACT(
                                        YEAR
                                        FROM(age(matchedUser.birthday))
                                      ) AS age,
                                      to_char(likedU.dateMatch, 'DD/MM/YYYY') AS date_match,
                                      CASE WHEN photo IS NOT NULL THEN photo.url ELSE 'Images/UserUpload/default.png' END AS photo_url,
                                      matchedUser.uniqId AS uniq_id,
                                      count(DISTINCT CASE WHEN messageContact.isRead = FALSE THEN messageContact.idMessage END) as unreadMessages
                                    FROM
                                      feediieuser matchedUser
                                      INNER JOIN likeduser likedU ON matchedUser.iduser = likedU.iduser_liked
                                      INNER JOIN feediieuser currentUser ON likedU.iduser = currentUser.iduser
                                      LEFT OUTER JOIN photo ON photo.idUser = matchedUser.idUser
                                      LEFT OUTER JOIN contact messageContact ON messageContact.idAuthor = matchedUser.idUser
                                      AND messageContact.idrecipient = currentuser.iduser
                                      LEFT OUTER JOIN contact messageUser ON messageUser.idAuthor = currentuser.idUser
                                      AND messageUser.idrecipient = matchedUser.iduser
                                    WHERE
                                      matched = true
                                      AND currentUser.iduser = ?
                                      AND (
                                        photo.priority = true
                                        OR photo IS NULL
                                      )
                                    GROUP BY
                                      name,
                                      age,
                                      likedU.dateMatch,
                                      photo_url,
                                      uniq_id
                                    ORDER BY
                                      CASE WHEN MAX(messageContact.dateMessage) is NULL
                                      AND MAX(messageUser.dateMessage) is null THEN make_date(1, 1, 1) ELSE (
                                        CASE WHEN MAX(messageUser.dateMessage) is NULL THEN MAX(messageContact.dateMessage) WHEN MAX(messageContact.dateMessage) is NULL THEN MAX(messageUser.dateMessage) WHEN MAX(messageContact.dateMessage) > MAX(messageUser.dateMessage) THEN MAX(messageContact.dateMessage) ELSE MAX(messageUser.dateMessage) END
                                      ) END DESC,
                                      date_match DESC
                                    ");
        $req->execute(array($userId));
        return $req->fetchAll();
    }

    public static function fetchMessages($userId, $contactId, $offset)
    {
        $req = self::$pdo->prepare("SELECT
                                        message,
                                        author.uniqid,
                                        datemessage
                                    
                                    FROM
                                        contact
                                    INNER JOIN feediieUser author ON idauthor = author.iduser
                                    
                                    WHERE
                                    (idAuthor = ? AND idRecipient = ?) OR (idAuthor = ? AND idRecipient = ?)
                                    
                                    ORDER BY idmessage DESC
                                    LIMIT 50
                                    OFFSET ?");

        $req->execute(array($userId, $contactId, $contactId, $userId, $offset));
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
    public static function addMessage($userId, $contactId, $message)
    {

        $req = self::$pdo->prepare("INSERT INTO contact (idAuthor, idRecipient, message, dateMessage) 
                                    VALUES (?, ?, ?, CURRENT_TIMESTAMP)                   
                                   ");
        return $req->execute(array($userId, $contactId, $message));
    }

    /**
     * Met à lu les messages envoyés par $contactId et non lu
     * Puis renvoie la liste des messages mis à jours
     * @param $userId l'id de l'utilisateur courrant
     * @param $contactId l'id du destinataire
     * @return mixed un tableau contenant la liste des messages ayant étés lus
     */
    public static function readNewMessages($userId, $contactId)
    {
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
                                    SELECT message, datemessage, author.uniqid as uniqid
                                    FROM 
                                    updatedMessages
                                    INNER JOIN feediieuser AS author ON author.iduser = updatedMessages.idAuthor
                                    ORDER BY idMessage DESC ;
                                    ");
        $req->execute(array($contactId, $userId));
        return $req->fetchAll();
    }

    public static function setReadToAllMessages($userId, $contactId)
    {
        $req = self::$pdo->prepare("UPDATE 
                                        contact
                                    SET 
                                        isread = TRUE
                                    WHERE
                                        idauthor = ?
                                        AND idrecipient = ?
                                        AND isread = FALSE;
                                    ");
        $req->execute(array($contactId, $userId));
    }

    public static function getUnreadMessagesCount($userId){
        $req = self::$pdo->prepare("SELECT
                                        count(*) as unreadmessages
                                    FROM
                                        contact
                                    WHERE 
                                        idrecipient = ?
                                        AND NOT isread;
                                    ");
        $req->execute(array($userId));
        return $req->fetch();
    }
}