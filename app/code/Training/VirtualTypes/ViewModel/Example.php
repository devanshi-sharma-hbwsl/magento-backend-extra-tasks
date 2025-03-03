<?php

namespace Training\VirtualTypes\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Training\VirtualTypes\Api\WarehouseRepoInterface;

class Example implements ArgumentInterface
{
    protected WarehouseRepoInterface $warehouseRepo;

    public function __construct(WarehouseRepoInterface $warehouseRepo)
    {
        $this->warehouseRepo = $warehouseRepo;
    }

    public function getWarehouse(string $code): array
    {
        $warehouse = $this->warehouseRepo->newWarehouse($code);
        return $warehouse->getData();
    }
}