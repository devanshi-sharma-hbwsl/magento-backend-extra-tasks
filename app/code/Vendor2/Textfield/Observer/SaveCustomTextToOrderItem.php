<?php
namespace Vendor2\Textfield\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;

class SaveCustomTextToOrderItem implements ObserverInterface
{
    public function execute(Observer $observer)
    {
        $quote = $observer->getEvent()->getQuote();
        $order = $observer->getEvent()->getOrder();

        foreach ($order->getAllItems() as $orderItem) {
            $quoteItem = $quote->getItemById($orderItem->getQuoteItemId());
            if ($quoteItem && $quoteItem->getCustomText()) {
                $orderItem->setCustomText($quoteItem->getCustomText());
            }
        }
    }
}
