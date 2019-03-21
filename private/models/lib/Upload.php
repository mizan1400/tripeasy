<?php

class Upload{

    private $basename;
    private $size;
    private $type;
    private $temp_file;
    private $errors;
    private $max_size = 500;

    function __construct($image){
        $this->type = pathinfo($image['name'], PATHINFO_EXTENSION);
        $this->basename = str_replace(("." . $this->type), "", $image['name']);
        $this->basename = str_replace(" ", "_", $this->basename);
        $this->size = $image['size'];
        $this->temp_file = $image['tmp_name'];
        $this->errors = new Errors();
    }

    public function get_errors(){
        return $this->errors;
    }

    public function set_max_size($max_size){
        $this->max_size = $max_size;
    }

    private function validate_size(){
        if ($this->size > ($this->max_size * 1024)) {
            return false;
        }
        return true;
    }

    public function get_file_name(){
        return $this->basename . "." . $this->type;
    }

    private function validate_type(){
        $img_ext = strtolower($this->type);
        if($img_ext != "jpg" && $img_ext != "png" && $img_ext != "jpeg" && $img_ext != "gif") {
            return false;
        }
        return true;
    }

    public function upload(){

        if(!$this->validate_type()){
            $this->errors->add_error("Invalid Image File");
        }else if(!$this->validate_size()){
            $this->errors->add_error("File can't be over " . $this->max_size . " MB");
        }

        if(empty($this->errors->errors)) {
            if (file_exists(UPLOAD_FOLDER . $this->basename . "." . $this->type)) {
                $this->basename = Helper::unique_code(16);
            }
            $target_file = UPLOAD_FOLDER . $this->basename . "." . $this->type;

            if(move_uploaded_file($this->temp_file, $target_file)){
                return true;
            }else{
                $this->errors->add_error("Something went wrong while uploading.");
                return false;
            }
        }
    }

    public function delete($image_name){
        $target_file = UPLOAD_FOLDER . $image_name;
        if (file_exists($target_file)) {
            unlink($target_file);
        }
    }


}