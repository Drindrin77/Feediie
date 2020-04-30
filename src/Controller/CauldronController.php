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
                    $usersMatched = UserModel::fetchMatchedUsers($currentUser["uniqid"]);
                    $defaultDiscussion = null;
                    if (sizeof($usersMatched) >= 1) {
                        $defaultDiscussion = UserModel::fetchMessages($currentUser["uniqid"], $usersMatched[0]['uniq_id'], 0);
                    }
                    $viewModel = $this->pageCauldron($usersMatched, $defaultDiscussion, $currentUser);
                    break;
            }
            return $viewModel;
        } else {
            return new ViewModel('Error403');
        }

    }

    public function pageCauldron($usersMatched, $defaultDiscussion, $currentUser)
    {
        $data = [
            "usersMatched" => $usersMatched,
            "defaultDiscussion" => $defaultDiscussion,
            "uniqId" => $currentUser["uniqid"],
            "userPhoto" => PhotoModel::getPriorityPhoto($currentUser['iduser'])
        ];
        return new ViewModel("Cauldron", $data);
    }
}

?>