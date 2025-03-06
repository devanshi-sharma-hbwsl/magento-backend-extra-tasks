<?php

namespace Devanshi\Mod18\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Checkout\Model\Cart;
use Magento\Quote\Model\Quote\Item;

class AdjustPriceObserver implements ObserverInterface
{
    public function execute(Observer $observer){
        $item = $observer->getEvent()->getItem();
        if($item){
            $newPrice=$item->getPrice()+1.79;
            $item->setCustomPrice($newPrice); 
        }
    }
}

?>