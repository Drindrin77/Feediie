<?php

if(!defined('CONST_INCLUDE'))
    die('Acces direct interdit !');

class CauldronController extends Controller{

    public function __construct() {
    }

    public function execute($action){
        if(AuthService::isAuthenticated()){
            switch($action){
                default:
                    $uniqID = AuthService::getCurrentUser()['uniqid'];
                    $usersMatched = UserModel::fetchMatchedUsers($uniqID);
                    $viewModel = $this->pageCauldron($usersMatched);
                    break;
            }
            return $viewModel;
        }else{
            return new ViewModel('Error403');
        }

    }
    public function pageCauldron($usersMatched){
        $data = [
            "usersMatched"=>$usersMatched
        ];
        return new ViewModel("Cauldron", $data);
    }
}

?>