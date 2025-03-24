<?php
namespace Devanshi\SpouseChildren\Model;

use Magento\Framework\Model\AbstractModel;

class FamilyInfo extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(\Devanshi\SpouseChildren\Model\ResourceModel\FamilyInfo::class);
    }
}
