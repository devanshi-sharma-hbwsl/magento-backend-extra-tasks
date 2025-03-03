<?php 
namespace Training\PoolPattern\Model;

class CodeLengthValidation implements CodeValidationInterface{
    public function validate($code):void{
        if(strlen($code) > 10){
            throw new \InvalidArgumentException('code length cannot be greater than 10');
        }
    }
}