<?php
namespace Vendor2\Textfield\Plugin;

use Magento\Checkout\Model\Cart;

class AddCustomTextToQuote
{
    public function beforeAddProduct(
        Cart $subject,
        $productInfo,
        $requestInfo = null
    ) {
        if ($requestInfo && isset($requestInfo['custom_text'])) {
            $requestInfo['product'] = $productInfo->getId();
            $subject->getQuote()->addProduct($productInfo, $requestInfo);
            return [$productInfo, $requestInfo];
        }
        
        return null;
    }
}