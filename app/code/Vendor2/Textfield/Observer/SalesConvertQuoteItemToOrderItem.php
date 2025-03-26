<?php
namespace Vendor2\Textfield\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;

class SalesConvertQuoteItemToOrderItem implements ObserverInterface
{
    public function execute(Observer $observer)
    {
        $orderItem = $observer->getEvent()->getOrderItem();
        $quoteItem = $observer->getEvent()->getItem();
        $orderItem->setCustomMessage($quoteItem->getCustomMessage());
    }
}
