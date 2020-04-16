<?php

if(!defined('CONST_INCLUDE'))
    die('Acces direct interdit !');

class ProfileController extends Controller{

    private $userModel;
	
	public function __construct() {

		$this->userModel = new UserModel();
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
        $userInfo = $this->userModel->getUserByUniqID($uniqID);
        //$photos = $this->userModel->getAllPhotos($uniqID);
        $photos = array('/Images/parameter.png','/Images/parameter.png','/Images/parameter.png');
        if(empty($userInfo)){
            return new ViewModel('UnknownUser');
        }else{
            $isCurrentUser = AuthService::getCurrentUser()['uniqid'] == $uniqID;
            $data = [
                'isCurrentUser'=> $isCurrentUser,
                'user'=>$userInfo,
                'photos'=>$photos
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