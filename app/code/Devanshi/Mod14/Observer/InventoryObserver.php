<?php
namespace Devanshi\Mod14\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;

class InventoryObserver implements ObserverInterface
{
    protected $logger;
    protected $eventManager;
    protected $threshold = 5; 

    public function __construct(
        LoggerInterface $logger,
        \Magento\Framework\Event\ManagerInterface $eventManager
    ) {
        $this->logger = $logger;
        $this->eventManager = $eventManager;
    }

    public function execute(Observer $observer)
    {
        $stockItem = $observer->getEvent()->getItem();
        $productId = $stockItem->getProductId();
        $qty = $stockItem->getQty();

        if ($qty < $this->threshold) {
            $this->logger->info("Devanshi - Low stock detected for product ID: $productId, Qty: $qty");

            
            $this->eventManager->dispatch(
                'devanshi_mod14_low_stock',
                ['product_id' => $productId, 'qty' => $qty]
            );
        }
    }
}
