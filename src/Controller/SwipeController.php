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
    public function pageSwipe()
    {

        $users = UserModel::getAllUser();
        foreach ($users as $user) {
            $idUser = $user['iduser'];
            $photos = PhotoModel::getAllPhotos($idUser);
            $data = [
                'users' => $users,
                'photos' => $photos,
            ];
            return new ViewModel("Swipe", $data);
        }
        return 0;
    }
}

?>