<?php

namespace Training\VirtualTypes\Api;

interface WarehouseMgmtInterface
{
    
    public function getWarehouseInfo(string $code): array;
}