<?php

namespace Devanshi\Mod15\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class OrderPlacement extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('devanshi_mod15_orders', 'id');
    }
}