<?php

namespace Devanshi\Mod15\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Psr\Log\LoggerInterface;
use Devanshi\Mod15\Model\OrderPlacementFactory;

class OrderPlacementObserver implements ObserverInterface
{
    protected $logger;
    protected $orderPlacementFactory;

    public function __construct(
        LoggerInterface $logger , 
        OrderPlacementFactory $orderPlacementFactory
    ) {
        $this->logger = $logger;
        $this->orderPlacementFactory = $orderPlacementFactory;
    }
    public function execute(Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();
        $amount = $order->getGrandTotal();
        $customerGroupId = $order->getCustomerGroupId();
        $this->logger->info("Order Group ID: " . $customerGroupId);
        $this->logger->info("Order Amount: " . $amount);
           if($customerGroupId == 1)
           {  
            $orderPlace=$this->orderPlacementFactory->create();
            $orderPlace->setData([
                'customer_group_id' => $customerGroupId,
                'total_sales_amount' => $amount
            ]);
            $orderPlace->save();
        }
    }
}

?>