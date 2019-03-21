<?php

class Errors{

    public $errors = [];

    public function add_error($error){
        array_push($this->errors, $error);
    }

    public function is_empty(){
        if(empty($this->errors)) return true;
        else return false;
    }

    public function get_error_str(){
        if(!empty($this->errors)) {
            $output = "";
            foreach($this->errors as $error){
                $output .= " " . $error;
            }
            return $output;
        }else return null;
    }

    public function format(){
        if(!empty($this->errors)) {
            $output = '<ul class="errors"><li><b>The Following erros occured</b></li>';
            foreach($this->errors as $error){
                $output .= '<li>'. $error .'</li>';
            }
            $output .= '</ul>';
            return $output;
        }else return null;
    }

}