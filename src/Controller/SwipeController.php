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

        $userFilterAgeDistance = ParameterModel::getUserFilterAgeDistance($idUser);
        $userSelectDistance = $userFilterAgeDistance[0]['distancemax'];
        $userSelectAge = array("agemin"=>$userFilterAgeDistance[0]['filteragemin'],"agemax"=>$userFilterAgeDistance[0]['filteragemax']);
        
        $sexs = SexModel::getAllSex();
        $diets = DietModel::getAllDiet();
        $relations = ParameterModel::getAllRelation();

        //FILTER (WITHOUT DISTANCE FILTER)
        $users = UserModel::filterUsersSwipe($idUser);
        //$users = UserModel::getAllUsers($idUser);
        var_dump($users);

        for($i=0; $i<count($users);$i++){
            $idUser = $users[$i]['iduser'];
            $users[$i]['photos'] = PhotoModel::getAllPhotos($idUser);
        }
        $data = [
            'userSelectedRelationType' =>$userSelectedRelationType,
            'userSelectedDiet' => $userSelectedDiet,
            'userSelectedGender' => $userSelectedGender,
            'userSelectDistance' => $userSelectDistance,
            'userSelectAge' => $userSelectAge,
            'users' => $users,
            'relations' => $relations,
            'sexs'=>$sexs,
            'diets'=>$diets,
        ];
        return new ViewModel("Swipe", $data);
    }
}

?>