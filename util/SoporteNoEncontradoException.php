<?php 
namespace util;
class SoporteNoEncontradoException extends VideoclubException{
    public function __construct(
        $message,
        $code = 0,
        $previa = null)
    {
        parent::__construct($message,$code,$previa);
    }

    public function messageException(){
        return $this->message;
    }
}
?>