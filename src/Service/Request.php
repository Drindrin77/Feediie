<?php
if(!defined('CONST_INCLUDE'))
	die('Acces direct interdit !'); 

abstract class Request{

    protected $response;
	
	public function __construct() {
        $this->response=array('error'=>array(),'success'=>array(),'data'=>array());
    }	

    private function isError(){
        return isset($response['error']);
    }

    public abstract function execute();


    protected function addMessageError($message){
        array_push($this->response['error'], $message);
    }
    
    protected function addMessageSuccess($message){
        array_push($this->response['success'], $message);
    }

    protected function addData($data){
        array_merge($this->response['data'], $data);
    }

  	public function sendRequest(){
        if ($this->isError())
        {
            //header('HTTP/1.1 500 Internal Server Booboo');
            //header('Content-Type: application/json; charset=UTF-8');
            die(json_encode($this->response));
            //$array = ["test"=>"test"];
            //var_dump($array);

        }
        else{
            //header('Content-Type: application/json');
           echo json_encode($this->response);
           //$array = ["test"=>"test"];
           //echo json_encode($array);
        }
    }
}

?>
