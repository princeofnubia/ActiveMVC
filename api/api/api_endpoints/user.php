<?php

class User extends Api_endpoints{

	public function __construct(){
		parent::__construct();
		if ($this->userExist()) {
			$this->isAuthenticated();
		}		
	}
	public function createUser(){
		$this->request_verifier('POST');
		$data = $_POST;
		if ($this->model->createUser($data)) {
			$this->report(parent::CREATION_SUCCESSFULL,true);
		}
		else{
			$this->report(parent::CREATE_FAILED);
		}
	}
	public function deleteUser($id){
		if ($id==NULL || !is_numeric($id)) {
			die($this->report(parent::FAIL));
		}		
		$this->request_verifier("DELETE");
		if (is_numeric($id) and $this->model->deleteUser($id)) {
			$this->report(parent::DELETE_SUCCESSFULL,true);
		}
		else{
			$this->report(parent::DELETE_FAILED);
		}
		
	}
	public function getUser($id = NULL){
		$this->request_verifier('GET');
		if (is_numeric($id) and $user = $this->model->getUser($id)) {
			return $this->json($user);
		}
		elseif ($id == "all" || $id == NULL) {
			if ($data=$this->model->getAll()) {
				return 	$this->json($data);
			}
			else{
				$this->report(parent::NO_RECORDS);
			}
		}
		else{
			$this->report(parent::FETCH_ERROR);
		}
	}

	public function updateUser(){
		$this->request_verifier('PUT');
		$data = array();
		$incoming = file_get_contents('php://input');
		parse_str($incoming, $data);
		if (isset($data['password'])) {
			$data['password'] = $this->salt($data['password']);
		}
		if (is_numeric($data['id']) and $this->model->updateUser($data)) {
			$this->report(parent::UPDATE_SUCCESSFULL,true);
		}
		else{
			$this->report(parent::UPDATE_FAILED);
		}		
	}

	private function userExist(){
		$user = $this->model->getAll();
		if ($user) {
			return true;
		}
		else{
			return false;
		}
	}
}