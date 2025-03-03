<?php

declare(strict_types=1);

namespace Training\DependencyExample\Model;

use Laminas\Router\Http\Method;
use Training\DependencyExample\Model\NonInjectable;
use Training\DependencyExample\Model\Injectable;
use Training\DependencyExample\Model\VirtualType\DefaultName;
use Magento\Framework\DataObject;

class Main
{
    protected array $data;
    protected Injectable $injectable;
    protected NonInjectableInterfaceFactory $nonInjectableFactory;
    protected AbstractUtil $util;
    protected HeavyOperation $heavyOperation;
    protected DefaultName $defaultName;
    protected Optional $optional;
    protected MethodInjection $methodInjection;

    public function __construct(
        InjectableInterface $injectable,
        NonInjectableInterfaceFactory $nonInjectableFactory,
        AbstractUtil $util,
        HeavyOperation $heavyOperation,
        DefaultName $defaultName,
        Optional $optional=null,
        MethodInjection $methodInjection,
        array $data=[]
    )
    {
        $this->data=$data;
        $this->injectable = $injectable;
        $this->nonInjectableFactory = $nonInjectableFactory;
        $this->util=$util;
        $this->heavyOperation=$heavyOperation;
        $this->defaultName=$defaultName;
        $this->optional=$optional;
        $this->methodInjection=$methodInjection;
    }

    public function getId(): string
    {
        return $this->data['id'];
    }

    public function getInjectable():Injectable
    {
        return $this->injectable;
    }

    public function getNonInjectable()
    {
        return $this->nonInjectableFactory->create();
    }

    public function getUtil()
    {
        return $this->util;
    }

    public function getHeavyOperation()
    {
        return $this->heavyOperation;
    }   

    public function getDefaultName()
    {
        return $this->defaultName;
    }

    public function getOptional()
    {
        return $this->optional;
    }

    public function getMethodInjectionName()
    {
        $dataObject = new DataObject(['name'=>'Method Injection']);
        return $this->methodInjection->getName($dataObject);
    }
}