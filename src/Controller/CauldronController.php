<?php

if (!defined('CONST_INCLUDE'))
    die('Acces direct interdit !');

class CauldronController extends Controller
{

    public function __construct()
    {
    }

    public function execute($action)
    {
        if (AuthService::isAuthenticated()) {
            switch ($action) {
                default:
                    $currentUser = AuthService::getCurrentUser();
                    $usersMatched = ChatModel::fetchMatchedUsers($currentUser["iduser"]);
                    $defaultDiscussion = null;
                    if (sizeof($usersMatched) >= 1) {
                        $contactId = UserModel::getUserByUniqID($usersMatched[0]['uniq_id'])['iduser'];
                        ChatModel::setReadToAllMessages($currentUser["iduser"], $contactId);
                        $defaultDiscussion = ChatModel::fetchMessages($currentUser["iduser"], $contactId, 0);
                    }
                    $viewModel = $this->pageCauldron($usersMatched, $defaultDiscussion, $currentUser);
                    break;
            }
            return $viewModel;
        } else {
            $this->redirectUser();
        }
        return null;
    }

    private function pageCauldron($usersMatched, $defaultDiscussion, $currentUser)
    {
        $data = [
            "usersMatched" => $usersMatched,
            "defaultDiscussion" => $defaultDiscussion,
            "uniqId" => $currentUser["uniqid"],
            "userPhoto" => (PhotoModel::getPriorityPhoto($currentUser['iduser']))
        ];
        return new ViewModel("Cauldron", $data);
    }


}

?>