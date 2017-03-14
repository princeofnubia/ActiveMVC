<?php
class Tax_model extends Api_model {
    protected $table = 'Tax';
    protected $fillable = ["name","percentage"];
    public function __construct(){
        parent::__construct();
    }
    public function createTax($data){
        if (array_diff(array_values($this->fillable),array_keys($data))) {
            $this->report(parent::ERR_POST_VAR); die();
        }       
        if (!is_numeric($data['percentage'])) {
            return false;
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
    public function deleteTax($id){
        try {
            $id = (int)$id;
           $this::where('id', $id)->delete(); 
        } catch (Exception $e) {
           return false;
        }
        return true;                
    }
    public function updateTax($post){
        try {
            $Tax = self::find($post['id']);
            foreach ($post as $key => $value) {
                $Tax->$key = $value;
            }
            $Tax->save();
        } catch (Exception $e) {
           return false;
        }
        return true;
    }
    public function getTax($id){
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