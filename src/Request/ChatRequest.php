<?php
if(!defined('CONST_INCLUDE'))
    die('Acces direct interdit !');

class ChatRequest extends RequestService{

    private $currentUser;
    public function __construct() {
        parent::__construct();
        $this->currentUser = AuthService::getCurrentUser();
    }

    public function execute($action){
        switch ($action){
            case "fetchmessages" :
                $test = $this->fetchMessages();
                break;
        }
    }

    private function fetchMessages(){
        $contactUniqId = isset($_POST["contactUniqId"]) && !empty($_POST['contactUniqId']) ? $_POST['contactUniqId'] : null;
        $offset = isset($_POST["offset"]) && !empty($_POST['offset']) ? $_POST['offset'] : 0;

        if($contactUniqId !== null) {
            $messageList = UserModel::fetchMessages($this->currentUser['uniqid'], $contactUniqId, $offset);
            $this->addData("messageList", $messageList);
            $this->addData("userPhoto", PhotoModel::getPriorityPhoto($this->currentUser['iduser'])['url']);
        }
    }
}