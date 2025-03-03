<?php 
namespace Training\PoolPattern\Model;

class CodeValidationPool
{
    /**
     * Summary of validations
     * @var array| CodeValidationInterface[]
     */
    protected array $validations;

    /**
     * Summary of __construct
     * @param array| CodeValidationInterface[] $validations
     */
    public function __construct(array $validations){
        $this->validations = $validations;
    }
    public function validate(string $code):void{
       foreach($this->validations as $validation){
        $validation->validate(code: $code);
       }
    }
}