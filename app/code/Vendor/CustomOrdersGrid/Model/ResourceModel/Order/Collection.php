<?php
namespace Vendor\CustomOrdersGrid\Model\ResourceModel\Order;

use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;

class Collection extends SearchResult
{
    protected function _initSelect()
    {
        parent::_initSelect();
        
        $this->getSelect()->joinLeft(
            ['order' => $this->getTable('sales_order')],
            'main_table.entity_id = order.entity_id',
            ['customer_firstname', 'customer_lastname']
        );
        
        $this->addExpressionFieldToSelect(
            'customer_name',
            "CONCAT(order.customer_firstname, ' ', order.customer_lastname)",
            ['customer_firstname' => 'order.customer_firstname', 'customer_lastname' => 'order.customer_lastname']
        );
        
        return $this;
    }

    public function applyFiltersFromRequest(\Magento\Framework\App\RequestInterface $request)
    {
        $params = $request->getParams();
        
        if (isset($params['filters'])) {
            $filters = $params['filters'];
            foreach ($filters as $field => $condition) {
                if (!empty($condition)) {
                    $this->addFieldToFilter($field, $condition);
                }
            }
        }
        
        return $this;
    }
}