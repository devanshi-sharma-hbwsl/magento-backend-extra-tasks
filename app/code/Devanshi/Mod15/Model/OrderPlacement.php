<?php

namespace Devanshi\Mod15\Model;

use Magento\Framework\Model\AbstractModel;
use Devanshi\Mod15\Model\ResourceModel\OrderPlacement as ResourceModel;

class OrderPlacement extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }
}