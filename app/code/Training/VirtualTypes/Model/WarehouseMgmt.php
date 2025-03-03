<?php

namespace Training\VirtualTypes\Model;

use Training\VirtualTypes\Api\WarehouseMgmtInterface;

class WarehouseMgmt implements WarehouseMgmtInterface
{
    
    public function getWarehouseInfo(string $code): array
    {
        return [
            'id' => $code,
            'name' => 'Warehouse ' . $code,
            'location' => 'Location ' . $code,
        ];
    }

    protected function getAllWarehouses(): array
    {
        return [
            [
                'id' => 'WH1',
                'name' => 'Warehouse 1',
                'location' => 'Location 1',
            ],
            [
                'id' => 'WH2',
                'name' => 'Warehouse 2',
                'location' => 'Location 2',
            ],
            [
                'id' => 'WH3',
                'name' => 'Warehouse 3',
                'location' => 'Location 3',
            ],
        ];
    }  
}