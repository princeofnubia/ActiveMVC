<?php
class Admin_model extends Api_model {
    const ACCESS_DENIED = 35;
    protected $table = 'User';
    protected $fillable = ["email","password","createdBy","userType","userRelatesTo","status"];
    public function __construct(){
        parent::__construct();
    }
    public function createAdmin($data){
        if ($this->adminExist()) {
            $data['password'] = $this->salt($data['password']);
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
        else{
            throw new Exception("",self::ACCESS_DENIED);
        }

    }
    private function adminExist(){
         try {
          if($records = $this::all()->toArray()){
             foreach($records as $record)
                {   
                    
                    unset($record['password']);
                    $rec [] = $record;
                }
                return $rec;
          }

        } catch (Exception $e) {
           return false;
        }
        return false;  
    }
}