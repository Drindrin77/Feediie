<?php

if(!defined('CONST_INCLUDE'))
    die('Acces direct interdit !');

class AdminController extends Controller{


	public function __construct() {
    }
    public function execute($action){
        switch($action){
            case null:
                if(AuthService::isAuthenticated() && AuthService::isAdmin()){
                    return $this->pageAdmin();
                }else{
                    return new ViewModel("Error404");
                }
            break;
            default:
                $this->redirectUser();
        }        
    }

    private function pageAdmin(){
        $idUser = AuthService::getCurrentUser()['iduser'];
        $ideas = IdeaModel::getAllIdea();
        $users = UserModel::getAllUserOrderReport($idUser);
        
        $allHobbies = HobbyModel::getAllHobbies();
        $allSexs = SexModel::getAllSex();
        $allCities = CityModel::getAllCity();
        $allPersonalities = PersonalityModel::getAllPersonalities();
        $allDishes = DishModel::getAllDishes();
        $allRelationType = RelationModel::getAllRelationType();
        $allDiets = DietModel::getAllDiet();

        $data = [
            'ideas' => $ideas,
            'users' => $users,
            'allHobbies'=>$allHobbies,
            'allPersonalities'=>$allPersonalities,
            'allCities'=>$allCities,
            'allSexs'=>$allSexs,
            'allDishes'=>$allDishes,
            'allRelationType'=>$allRelationType,
            'allDiets'=>$allDiets
        ];
        return new ViewModel("Admin",$data);
    }
}

?>