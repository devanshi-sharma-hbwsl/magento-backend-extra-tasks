<?php
namespace Vendor3\Compare\Plugin\Block\Product;

use Magento\Catalog\Block\Product\ListProduct as CoreListProduct;
use Vendor3\Compare\Block\CompareButton;

class ListProductPlugin
{
    public function afterGetProductDetailsHtml(CoreListProduct $subject, $result, $product)
    {
        $compareButton = $subject->getLayout()->getBlock('compare.button');
        if ($compareButton instanceof CompareButton) {
            $selectedProducts = $compareButton->getSelectedProducts();
            $compareButton->setSelectedProducts($selectedProducts);
        }
        return $result;
    }
}