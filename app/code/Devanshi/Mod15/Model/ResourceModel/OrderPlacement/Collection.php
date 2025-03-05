<?php
namespace Devanshi\Mod15\Model\ResourceModel\Car;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Devanshi\Mod15\Model\OrderPlacement as Model;
use Devanshi\Mod15\Model\ResourceModel\OrderPlacement as ResourceModel;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
