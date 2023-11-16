<?php
namespace Munna\IpLocation\Exceptions;
use Exception;

class IpLocationException extends Exception{

    // Define Message
    public $message;

    // Constructor
    public function __construct($message){
        $this->message = $message;
    }

    // repoter
    public function report(){

    }

    // render
    public function render(){
        return response()->json(['status' => false, 'message' => $this->message]);
    }

}
