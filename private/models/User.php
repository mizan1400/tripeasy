<?php

class User extends Helper{

    public $id;
    public $username;
    public $email;
    public $password;
    public $type;
    public $social_id;
    public $verification_token;
    public $status = 0;
    public $admin_id;

    public function save(){
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
        return parent::save();
    }

    public function verify_login(){
        $user_frm_db = $this->where(["email" => $this->email])->one();

        if(!empty($user_frm_db)) {
            if(password_verify($this->password, $user_frm_db->password)) {
                return $user_frm_db;
            }
        }
        return null;
    }


}