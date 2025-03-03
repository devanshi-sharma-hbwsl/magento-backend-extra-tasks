<?php
namespace Devanshi\Mod2\Plugin;

class ProductPlugin
{
    public function afterGetName(\Magento\Catalog\Model\Product $subject, $result)
    {
        if ($subject->getFinalPrice() < 60) {
            return $result . ' On Sale! by Devanshi';
        }
        return $result;
    }
}
