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
        $userInfo = UserModel::getUserByUniqID($uniqID);
        
        if(empty($userInfo)){
            return new ViewModel('UnknownUser');
        }else{
            $isCurrentUser = AuthService::getCurrentUser()['uniqid'] == $uniqID;
            $idUser = $userInfo['iduser'];
            $photos = PhotoModel::getAllPhotos($idUser);
            $personalities = PersonalityModel::getUserPersonalities($idUser);
            $hobbies = HobbyModel::getUserHobbies($idUser);
            $favoriteDish = DishModel::getUserFavoritesDishes($idUser);

            $data = [
                'isCurrentUser'=> $isCurrentUser,
                'user'=>$userInfo,
                'photos'=>$photos,
                'personalities'=>$personalities,
                'hobbies'=>$hobbies,
                'favoriteDish'=>$favoriteDish,
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
            'allDish'=>$allDish
        ];
        
        return new ViewModel('ProfileEdit', $data);
    }
}

?>