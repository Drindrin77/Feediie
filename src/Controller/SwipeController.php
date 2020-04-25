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
        $idUser = AuthService::getCurrentUser()['iduser'];
        $users = UserModel::getAllUser($idUser);
        $sexs = SexModel::getAllSex();
        $diets = DietModel::getAllDiet();
        $userSelectedDiet = DietModel::getUserSelectedDiet($idUser);
        $filteredUser = array();

        //TODO GET DEFAULT PARAMETER USER
        foreach($users as $user) {
            $idUser = $user['iduser'];
            $user['photos'] = PhotoModel::getAllPhotos($idUser);
            array_push($filteredUser,$user);
        }
        $data = [
            '$userSelectedDiet' => $userSelectedDiet,
            'users' => $filteredUser,
            "sexs"=>$sexs,
            "diets"=>$diets,
        ];
        var_dump($userSelectedDiet);

        return new ViewModel("Swipe", $data);
    }
}

?>