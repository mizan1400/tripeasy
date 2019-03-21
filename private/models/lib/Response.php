<?php


class Response{
    public $status_code;
    public $message;
    public $data;

    public function create($status_code, $message, $data){
        $this->status_code = $status_code;
        $this->message = $message;
        $this->data = $data;
    }

    public function response(){
        return json_encode($this);
    }

}