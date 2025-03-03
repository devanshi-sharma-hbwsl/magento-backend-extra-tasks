<?php

declare(strict_types=1);

namespace Training\InjectablesAndNonInjectablesExample\Service;

use Training\InjectablesAndNonInjectablesExample\Model\Supplier;
// use Training\InjectablesAndNonInjectablesExample\Model\Item;

class Demand
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
        return $this->supplier;
    }

    // public function getItem()
    // {
    //     return $this->itemFactory->create();
    // }
}