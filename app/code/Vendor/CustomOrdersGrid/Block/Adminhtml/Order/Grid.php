<?php
namespace Vendor\CustomOrdersGrid\Block\Adminhtml\Order;

class Grid extends \Magento\Backend\Block\Widget\Grid\Container
{
    protected function _construct()
    {
        $this->_controller = 'order';
        $this->_blockGroup = 'Vendor_CustomOrdersGrid';
        $this->_headerText = __('Custom Sales Orders');
        $this->addButtonLabel = __('Add New Order');
        parent::_construct();
        $this->removeButton('add');
    }
}