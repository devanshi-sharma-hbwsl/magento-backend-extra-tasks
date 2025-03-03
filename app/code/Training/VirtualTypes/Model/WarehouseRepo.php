<?php

namespace Training\VirtualTypes\Model;

use Training\VirtualTypes\Api\WarehouseRepoInterface;
use Magento\Framework\DataObject;
use Training\VirtualTypes\Api\WarehouseMgmtInterface;

class WarehouseRepo implements WarehouseRepoInterface
{
    protected WarehouseMgmtInterface $warehouseMgmt;

    public function __construct(WarehouseMgmtInterface $warehouseMgmt)
    {   
        $this->warehouseMgmt = $warehouseMgmt;
    }

    public function newWarehouse(string $code): DataObject
    {
        $warehouseInfo = $this->warehouseMgmt->getWarehouseInfo($code);
        return new DataObject($warehouseInfo);
    }
}