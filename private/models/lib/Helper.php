
<?php

class Helper extends Database{

    private $errors;

    function __construct(){
        parent::__construct();
        $this->errors = new Errors();
    }

    public function getVariables(){
        $columns = [];
        foreach ($this as $key => $value) {
            if($key == "errors") continue;
            $columns[$key] = $value;
        }
        return $columns;
    }

    public function get_errors(){
        return $this->errors;
    }

    public function validate(){
        foreach ($this as $key => $value){
            if(empty($value)) $this->errors->add_error(ucfirst($key) . " can't be empty.");
        }
    }

    public function validate_with($with){
        if(count($with) > 1) $with_str = implode("|", ucfirst($with));
        else if(count($with) == 1) $with_str = ucfirst($with);

        foreach ($this as $key => $value){
            if(strpos($with_str, ucfirst($key)) === false) continue;
            if(empty($value)) $this->errors->add_error(ucfirst($key) . " can't be empty.");
        }
    }

    public function validate_except($except){
        if(count($except) > 1) $except_str = implode("|", ucfirst($except));
        else if(count($except) == 1) $except_str = ucfirst($except);
        foreach ($this as $key => $value){
            if(strpos($except_str, ucfirst($key)) !== false) continue;
            if(empty($value)) $this->errors->add_error(ucfirst($key) . " can't be empty.");
        }
    }

    public static function redirect_to($url){
        header('Location: ' . $url);
    }

    public static function is_post(){
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    public static function is_get(){
        return $_SERVER['REQUEST_METHOD'] === 'GET';
    }

    public static function validateEmail($email) {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) return "Invalid Email";
        else return null;
    }

    public static function invalid_length($key, $value, $length){
        if(strlen($value) < $length)  return ucfirst($key) . ' must be at least ' . $length . ' char long.';
        else return null;
    }

    public static function unique_code($limit){
        return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
    }
    
}