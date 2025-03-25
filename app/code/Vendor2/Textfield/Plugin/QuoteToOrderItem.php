<?php
namespace Vendor2\Textfield\Plugin;

class QuoteToOrderItem
{
    public function aroundConvert(
        \Magento\Quote\Model\Quote\Item\ToOrderItem $subject,
        \Closure $proceed,
        \Magento\Quote\Model\Quote\Item\AbstractItem $item,
        $additional = []
    ) {
        $orderItem = $proceed($item, $additional);
        
        $customText = $item->getOptionByCode('custom_text');
        if ($customText) {
            $orderItem->setCustomText($customText->getValue());
        }
        
        return $orderItem;
    }
}