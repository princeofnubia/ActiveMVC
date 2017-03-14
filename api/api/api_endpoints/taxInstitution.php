<?php

class TaxInstitution extends Api_endpoints{

	public function __construct(){
		parent::__construct();
		$this->isAuthenticated();
	}
	public function createTaxInstitution(){
		$this->request_verifier('POST');
		$data = $_POST;
		if ($this->model->createTaxInstitution($data)) {
			$this->report(parent::CREATION_SUCCESSFULL,true);
		}
		else{
			$this->report(parent::CREATE_FAILED);
		}
	}
	public function deleteTaxInstitution($id){
		if ($id==NULL || !is_numeric($id)) {
			die($this->report(parent::FAIL));
		}
		$this->request_verifier("DELETE");
		if (is_numeric($id) and $this->model->deleteTaxInstitution($id)) {
			$this->report(parent::DELETE_SUCCESSFULL,true);
		}
		else{
			$this->report(parent::DELETE_FAILED);
		}
		
	}
	public function getTaxInstitution($id=NULL){
		$this->request_verifier('GET');
		if (is_numeric($id) and $TaxInstitution = $this->model->getTaxInstitution($id)) {
			return $this->json($TaxInstitution);
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

	public function updateTaxInstitution(){
		$this->request_verifier('PUT');
		$data = array();
		$incoming = file_get_contents('php://input');
		parse_str($incoming, $data);
		if (is_numeric($data['id']) and $this->model->updateTaxInstitution($data)) {
			$this->report(parent::UPDATE_SUCCESSFULL,true);
		}
		else{
			$this->report(parent::UPDATE_FAILED);
		}		
	}
}