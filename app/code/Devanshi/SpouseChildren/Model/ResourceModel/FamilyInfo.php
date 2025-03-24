<?php
namespace Devanshi\SpouseChildren\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class FamilyInfo extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('devanshi_spouse_children', 'id');
    }
}
