<?php
if (!defined('CONST_INCLUDE'))
    die('Acces direct interdit !');

class ChatRequest extends RequestService
{

    private $currentUser;

    public function __construct()
    {
        parent::__construct();
        $this->currentUser = AuthService::getCurrentUser();
    }

    public function execute($action)
    {
        switch ($action) {
            case "fetchmessages" :
                $this->fetchMessages();
                break;
            case "sendmessage":
                $this->sendMessage();
                break;
        }
    }

    private function fetchMessages()
    {
        $contactUniqId = isset($_POST["contactUniqId"]) && !empty($_POST['contactUniqId']) ? $_POST['contactUniqId'] : null;
        $offset = isset($_POST["offset"]) && !empty($_POST['offset']) ? $_POST['offset'] : 0;

        if ($contactUniqId !== null) {
            $contactId = UserModel::getUserByUniqID($contactUniqId)['iduser'];

            ChatModel::setReadToAllMessages($this->currentUser["iduser"], $contactId);
            $messageList = ChatModel::fetchMessages($this->currentUser['iduser'], $contactId, $offset);

            for ($i = 0; $i < sizeof($messageList); $i++) {
                $messageList[$i]["message"] = htmlspecialchars($messageList[$i]["message"]);

            }
            $this->addData("messageList", $messageList);
            $this->addData("userPhoto", PhotoModel::getPriorityPhoto($this->currentUser['iduser'])['url']);
        }
    }

    private function sendMessage()
    {
        $contactUniqId = isset($_POST["contactUniqId"]) && !empty($_POST['contactUniqId']) ? $_POST['contactUniqId'] : null;
        $inputMessage = isset($_POST["inputMessage"]) && !empty($_POST['inputMessage']) ? $_POST['inputMessage'] : null;

        if($contactUniqId !== null && $inputMessage !== null){
            $userId = $this->currentUser['iduser'];
            $contactId = UserModel::getUserByUniqID($contactUniqId)["iduser"];

            $unreadMessages = ChatModel::readMessages($userId, $contactId);
            for ($i = 0; $i < sizeof($unreadMessages); $i++) {
                $unreadMessages[$i]["message"] = htmlspecialchars($unreadMessages[$i]["message"]);
            }
            $this->addData("messageList", $unreadMessages);

            $isInserted = ChatModel::addMessage($userId, $contactId, $inputMessage);
            if($isInserted){
                $this->addData("isInserted", true);
                $this->addData("userPhoto", PhotoModel::getPriorityPhoto($this->currentUser['iduser'])['url']);
            }
        }
    }
}