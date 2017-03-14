<?php
class ResetPassword_model extends Api_model {
    protected $table = 'User';
    protected $fillable = ["email","password","createdBy","userType","userRelatesTo","status"];
    public function __construct(){
        parent::__construct();
    }
    public function resetPassword($data){
        $data['password'] = $this->salt($data['password']); 
         try {
            $user_data = self::find($data['id']);
            foreach ($data as $key => $value) {
                $user_data->$key = $value;
            }
            $user_data->save();
        } catch (Exception $e) {
           return false;
        }
        return true;
    }
}