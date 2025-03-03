<?php 
namespace Training\PoolPattern\Model;

class CodeNotEmptyValidation implements CodeValidationInterface{
    public function validate($code):void{
        if($code===''){
            throw new \InvalidArgumentException('Devanshi, empty code,code cannot be empty');
        }
    }
}