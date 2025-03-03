<?php

namespace Devanshi\Mod3\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;
use Magento\Framework\App\ResponseInterface;

class PageLog implements ObserverInterface
{
    private LoggerInterface $logger;
    private ResponseInterface $response;

    public function __construct(LoggerInterface $logger, ResponseInterface $response)
    {
        $this->logger = $logger;
        $this->response = $response;
    }

    public function execute(Observer $observer)
    {
        $html = $this->response->getBody();
        $this->logger->info('Page HTML: ' . $html);
    }
}