<?php
namespace Vendor3\Compare\Block;

use Magento\Framework\View\Element\Template;

class CompareButton extends Template
{
    protected $_template = 'Vendor3_Compare::product/compare/button.phtml';
    protected $_compareProducts = [];

    public function __construct(
        Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_compareProducts = $data['selected_products'] ?? [];
    }

    public function getSelectedProducts()
    {
        return $this->_compareProducts;
    }

    public function setSelectedProducts(array $products)
    {
        $this->_compareProducts = $products;
        return $this;
    }

    public function getCompareUrl()
    {
        return $this->getUrl('compare/products/index');
    }

    public function canShow()
    {
        return count($this->_compareProducts) >= 2;
    }

    public function isDisabled()
    {
        return count($this->_compareProducts) > 2;
    }
}