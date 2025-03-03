<?php

namespace Training\VirtualTypes\Api;

use Magento\Framework\DataObject;

interface WarehouseRepoInterface
{
    public function newWarehouse(string $code): DataObject;
}