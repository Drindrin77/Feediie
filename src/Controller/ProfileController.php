<?php

if(!defined('CONST_INCLUDE'))
    die('Acces direct interdit !');

class ProfileController extends Controller{
	
	public function __construct() {
    }

    public function execute($action){
        switch($action){
            case "edit":
                if(!AuthService::isAuthenticated()){
                    $this->redirectUser();
                }else{
                    $viewModel = $this->editProfile();
                }
            break;
            
            default:
                if(!AuthService::isAuthenticated()){
                    $this->redirectUser();
                }else{
                    $viewModel = $this->viewProfile($action);
                }
        }
        return $viewModel;
    }

    private function viewProfile($uniqID){
        $user = UserModel::getUserByUniqID($uniqID);
        if(empty($user)){
            return new ViewModel('UnknownUser');
        }else{
            $isCurrentUser = AuthService::getCurrentUser()['uniqid'] == $uniqID;
            $idUser = $user['iduser'];
            
            $user['photos']=PhotoModel::getAllPhotos($idUser);
            $user['personalities']=PersonalityModel::getUserPersonalities($idUser);
            $user['hobbies']= HobbyModel::getUserHobbies($idUser);
            $user['favoriteDish'] = DishModel::getUserFavoritesDishes($idUser);
            $user['diets'] = DietModel::getUserDiet($idUser);
            
            $data = [
                'isCurrentUser'=> $isCurrentUser,
                'user'=>$user,
            ];
            return new ViewModel('ProfileView',$data);
        }
    }

    private function editProfile(){

        $user = AuthService::getCurrentUser();
        $idUser = $user['iduser'];

        $allHobbies = HobbyModel::getUnpracticedHobbies($idUser);
        $allSexs = SexModel::getAllSex();
        $allCities = CityModel::getAllCity();
        $allPersonalities = PersonalityModel::getUnusedPersonalities($idUser);
        $allDish = DishModel::getUnusedDishes($idUser);
        $photos = PhotoModel::getAllPhotos($idUser);
        $personalities = PersonalityModel::getUserPersonalities($idUser);
        $hobbies = HobbyModel::getUserHobbies($idUser);
        $favoriteDish = DishModel::getUserFavoritesDishes($idUser);
        $policy = PasswordService::policyToString();
        $allDiets = DietModel::getAllDiet();
        $diets = DietModel::getUserDiet($idUser);

        $data = [
            'user'=>$user,
            'photos'=>$photos,
            'personalities'=>$personalities,
            'hobbies'=>$hobbies,
            'favoriteDish'=>$favoriteDish,
            'allHobbies'=>$allHobbies,
            'allPersonalities'=>$allPersonalities,
            'allCities'=>$allCities,
            'allSexs'=>$allSexs,
            'allDish'=>$allDish,
            'policy' => $policy,
            'allDiets'=>$allDiets,
            'diets'=>$diets
        ];
        
        return new ViewModel('ProfileEdit', $data);
    }
}

?>