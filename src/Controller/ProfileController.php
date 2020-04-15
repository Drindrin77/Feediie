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
        if(empty($userInfo)){
            return new ViewModel('UnknownUser');
        }else{
            $isCurrentUser = AuthService::getCurrentUser()['uniqid'] == $userInfo['uniqid'];
            $data = [
                'isCurrentUser'=> $isCurrentUser,
                'users'=>$userInfo
            ];
           // var_dump($data);

            return new ViewModel('ProfileView',$data);
        }

    }

    private function edit(){
        //$data = $this->userModel->getInfo();
        return new ViewModel('ProfilEdit');
    }
}

?>