<?php

if(!defined('CONST_INCLUDE'))
    die('Acces direct interdit !');

class SwipeController extends Controller{
	
	public function __construct() {
    }

    public function execute($action){
        if(AuthService::isAuthenticated()){
            switch($action){
                //TODO
                default:
                    $viewModel = $this->pageSwipe();
                break;
            }
            return $viewModel;
        }else{
            return new ViewModel('Error403');
        }
        
    }
    public function pageSwipe(){

        $users = UserModel::getAllUser();
        $data = [
            "users"=>$users
        ];
        return new ViewModel("Swipe", $data);
    }
}

?>