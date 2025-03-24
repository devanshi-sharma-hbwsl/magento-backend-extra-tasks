<?php
namespace Devanshi\SpouseChildren\Model\ResourceModel\FamilyInfo;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Devanshi\SpouseChildren\Model\FamilyInfo as Model;
use Devanshi\SpouseChildren\Model\ResourceModel\FamilyInfo as ResourceModel;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
