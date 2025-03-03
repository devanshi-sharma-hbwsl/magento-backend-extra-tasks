<?php

namespace Training\VirtualTypes\Model;

class WarehouseMgmtExtended extends WarehouseMgmt
{
  
    protected function getAllWarehouses(): array
    {
        $baseWarehouses = parent::getAllWarehouses();
        $additionalWarehouses = [
            [
                'id' => 'WH4',
                'name' => 'Warehouse 4',
                'location' => 'Location 4',
            ],
            [
                'id' => 'WH5',
                'name' => 'Warehouse 5',
                'location' => 'Location 5',
            ],
        ];

        return array_merge($baseWarehouses, $additionalWarehouses);
    }
}