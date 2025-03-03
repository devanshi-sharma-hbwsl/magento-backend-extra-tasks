<?php
namespace Training\ObserverExample\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Training\ObserverExample\Logger\Logger;

class Example implements ObserverInterface
{
    protected Logger $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function execute(Observer $observer)
    {
        $this->logger->info('event triggered, product added to cart');
    }
}