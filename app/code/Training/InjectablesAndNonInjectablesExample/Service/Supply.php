<?php

declare(strict_types=1);

namespace Training\InjectablesAndNonInjectablesExample\Service;

use Training\InjectablesAndNonInjectablesExample\Model\Supplier;
// use Training\InjectablesAndNonInjectablesExample\Model\Item;

class Supply
{
    protected Supplier $supplier;
    // protected ItemFactory $itemFactory;

    public function __construct(Supplier $supplier)
    {   
        $this->supplier = $supplier;
        // $this->itemFactory = $itemFactory;
    }

    public function getSupplier()
    {
        $this->supplier->setCode('123ABC');
        return $this->supplier;
    }

    // public function getItem()
    // {
    //     $item=$this->itemFactory->create();
    //     $item->setCode('456DEF');
    //     return $item;
    // }
}