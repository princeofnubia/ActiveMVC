<?php
class TaxInstitution_model extends Api_model {
    protected $table = 'TaxInstitution';
    protected $fillable = ["instName","officeLocation","status"];
    public function __construct(){
        parent::__construct();
    }
    public function createTaxInstitution($data){
        if (array_diff(array_values($this->fillable),array_keys($data))) {
            $this->report(parent::ERR_POST_VAR); die();
        }
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
        try {
           $this::save(); 
        } catch (Exception $e) {
           return false;
        }
        return true;
    }
    public function deleteTaxInstitution($id){
        try {
            $id = (int)$id;
           $this::where('id', $id)->delete(); 
        } catch (Exception $e) {
           return false;
        }
        return true;                
    }
    public function updateTaxInstitution($post){
        try {
            $TaxInstitution = self::find($post['id']);
            foreach ($post as $key => $value) {
                $TaxInstitution->$key = $value;
            }
            $TaxInstitution->save();
        } catch (Exception $e) {
           return false;
        }
        return true;
    }
    public function getTaxInstitution($id){
        try {
          $record = self::where('id', $id)->first(); 
        } catch (Exception $e) {
           $this->model_error_report($e);
        }
        return $record;        
    }
    public function getAll(){
         try {
          if($record = $this::all()->toArray()){
                return $record; 
          }

        } catch (Exception $e) {
           return false;
        }
        return false;  
    }
}