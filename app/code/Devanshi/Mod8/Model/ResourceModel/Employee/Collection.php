<?php
namespace Devanshi\Mod8\Model\ResourceModel\Employee;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Devanshi\Mod8\Model\Employee;
use Devanshi\Mod8\Model\ResourceModel\Employee as EmployeeResource;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Employee::class, EmployeeResource::class);
    }
}
