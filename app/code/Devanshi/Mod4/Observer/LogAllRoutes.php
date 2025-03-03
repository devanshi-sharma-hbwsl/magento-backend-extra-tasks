<?php

namespace Devanshi\Mod4\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Psr\Log\LoggerInterface;
use Magento\Framework\App\RouterListInterface;	

class LogAllRoutes implements ObserverInterface
{
    protected $logger;
    protected $routerList;

    public function __construct(
        LoggerInterface $logger,
        RouterListInterface $routerList
    ) 
    {
        $this->logger = $logger;
        $this->routerList = $routerList;
    }
    public function execute(Observer $observer)
    {
        foreach($this->routerList as $route)
        {
            $this->logger->info("Devanshi - available route:" . get_class($route));
        }
    }
}

?>
