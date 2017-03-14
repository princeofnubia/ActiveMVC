<?php
class Outlet_model extends Api_model {
    protected $table = 'outlet';
    protected $fillable = ["orgID","outletName","officeLocation","status"];
    public function __construct(){
        parent::__construct();
    }
    public function createOutlet($data){
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
    public function deleteOutlet($id){
        try {
            $id = (int)$id;
           $this::where('id', $id)->delete(); 
        } catch (Exception $e) {
           return false;
        }
        return true;                
    }
    public function updateOutlet($post){
        try {
            $Outlet = self::find($post['id']);
            foreach ($post as $key => $value) {
                $Outlet->$key = $value;
            }
            $Outlet->save();
        } catch (Exception $e) {
           return false;
        }
        return true;
    }
    public function getOutlet($id){
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