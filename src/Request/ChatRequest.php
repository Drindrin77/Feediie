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
        //$this->addData("messageList", "test stp");
        switch ($action){
            case "fetchmessages" :
                $test = $this->fetchMessages();
                break;
        }
    }

    private function fetchMessages(){
        $contactUniqId = isset($_POST["contactUniqId"]) && !empty($_POST['contactUniqId']) ? $_POST['contactUniqId'] : null;

        if($contactUniqId !== null) {
            $data = UserModel::fetchMessages($this->currentUser['uniqid'], $contactUniqId);
            $this->addData("messageList", $data);
        }
    }
}