<?php

if(!defined('CONST_INCLUDE'))
    die('Acces direct interdit !');

class ProfileController extends Controller{
	
	public function __construct() {
    }

    public function execute($action){
        switch($action){
            case "edit":
                $viewModel = $this->edit();
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
        $idUser = $userInfo['iduser'];
        $photos = PhotoModel::getAllPhotos($idUser);
        $personalities = DishModel::getAllPersonnalities($idUser);
        $hobbies = HobbyModel::getAllHobbies($idUser);
        $favoriteDish = DishModel::getAllFavoritesDishes($idUser);

        if(empty($userInfo)){
            return new ViewModel('UnknownUser');
        }else{
            $isCurrentUser = AuthService::getCurrentUser()['uniqid'] == $uniqID;
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

    private function edit(){
        //$data = $this->userModel->getInfo();
        return new ViewModel('ProfileEdit');
    }
}

?>