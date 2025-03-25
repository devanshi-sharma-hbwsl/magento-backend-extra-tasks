<?php
namespace Vendor2\Textfield\Plugin;

use Magento\Quote\Model\Quote\Item\ToOrderItem;
use Magento\Quote\Model\Quote\Item\AbstractItem;
use Magento\Sales\Model\Order\Item;

class AddCustomTextToOrder
{
    public function aroundConvert(
        ToOrderItem $subject,
        \Closure $proceed,
        AbstractItem $item,
        $additional = []
    ) {
        /** @var Item $orderItem */
        $orderItem = $proceed($item, $additional);
        
        $quoteItem = $item;
        if ($quoteItem->getCustomText()) {
            $orderItem->setCustomText($quoteItem->getCustomText());
            $orderItem->setCustomTextLength($quoteItem->getCustomTextLength());
        }
        
        return $orderItem;
    }
}