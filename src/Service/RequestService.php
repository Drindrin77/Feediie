<?php
if(!defined('CONST_INCLUDE'))
	die('Acces direct interdit !'); 

abstract class RequestService{

    protected $response;
	
	public function __construct() {
        $this->response=array('status'=>'','error'=>array(),'success'=>array(),'data'=>array());
    }	

    private function addStatus(){
        $this->response['status'] = empty($this->response['error'])?'success':'error';
    }

    public abstract function execute($action);

    protected function addMessageError($message){
        array_push($this->response['error'], $message);
    }
    
    protected function addMessageSuccess($message){
        array_push($this->response['success'], $message);
    }

    protected function addData($data){
        array_push($this->response['data'], $data);
    }

  	public function sendRequest(){
        $this->addStatus();
        echo json_encode($this->response);
    }
}

?>
