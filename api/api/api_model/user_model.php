<?php
class User_model extends Api_model {
    const MAIL_EXIST = 34;
    protected $table = 'User';
    protected $fillable = ["email","password","createdBy","userType","userRelatesTo","status"];
    public function __construct(){
        parent::__construct();
    }
    public function createUser($data){
        $email = self::where('email', $data['email'])->first(); 
        if ($email['email'] == $data['email']) {
            die($this->report(self::MAIL_EXIST)); 
        }
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
    public function deleteUser($id){
        try {
            $id = (int)$id;
           $this::where('id', $id)->delete(); 
        } catch (Exception $e) {
           return false;
        }
        return true;                
    }
    public function updateUser($post){
        try {
            $user = self::find($post['id']);
            foreach ($post as $key => $value) {
                $User->$key = $value;
            }
            $user->save();
        } catch (Exception $e) {
           return false;
        }
        return true;
    }
    public function getUser($id){
        try {
          $record = self::where('id', $id)->first(); 
          unset($record['password']);
        } catch (Exception $e) {
           $this->model_error_report($e);
        }
        return $record;        
    }
    public function getAll(){
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