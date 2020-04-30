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
        $userSelectedDiet = DietModel::getUserSelectedDiet($idUser);
        $userSelectedGender = SexModel::getUserSelectedGender($idUser);
        $userSelectedRelationType = ParameterModel::getUserSelectedRelation($idUser);
        $userSelectDistance = ParameterModel::getRangeDistance($idUser);
        $userSelectAge = ParameterModel::getRangeAge($idUser);
        $users = UserModel::getAllUser($idUser);
        $sexs = SexModel::getAllSex();
        $diets = DietModel::getAllDiet();
        $relations = ParameterModel::getAllRelation();
        $filteredUser = array();
        var_dump($userSelectedRelationType);
        var_dump($relations);
        //TODO GET DEFAULT PARAMETER USER
        foreach($users as $user) {
            $idUser = $user['iduser'];
            $user['photos'] = PhotoModel::getAllPhotos($idUser);
            array_push($filteredUser,$user);
        }
        $data = [
            'userSelectedRelationType' =>$userSelectedRelationType,
            'userSelectedDiet' => $userSelectedDiet,
            'userSelectedGender' => $userSelectedGender,
            'userSelectDistance' => $userSelectDistance,
            'userSelectAge' => $userSelectAge,
            'users' => $filteredUser,
            'relations' => $relations,
            'sexs'=>$sexs,
            'diets'=>$diets,
        ];
        return new ViewModel("Swipe", $data);
    }
}

?>