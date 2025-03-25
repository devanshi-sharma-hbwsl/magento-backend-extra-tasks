<?php
namespace Vendor\CustomOrdersGrid\Model\ResourceModel\Order;

class Collection extends \Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult
{
    protected function _initSelect()
    {
        parent::_initSelect();
        
        $this->addFieldToSelect([
            'entity_id',
            'increment_id',
            'created_at',
            'grand_total',
            'customer_firstname',
            'customer_lastname'
        ]);
        
        $this->addExpressionFieldToSelect(
            'customer_name',
            "CONCAT({{customer_firstname}}, ' ', {{customer_lastname}})",
            ['customer_firstname' => 'customer_firstname', 'customer_lastname' => 'customer_lastname']
        );
        
        return $this;
    }
}