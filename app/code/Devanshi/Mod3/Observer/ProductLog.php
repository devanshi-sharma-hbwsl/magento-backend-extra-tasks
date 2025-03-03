<?php

namespace Devanshi\Mod3\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;

class ProductLog implements ObserverInterface{

    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function execute(Observer $observer)
    {
        $product = $observer->getEvent()->getProduct();
        if($product){
            $this->logger->info('Devanshi Product viewed : ' . $product -> getName());
        }
    }
}