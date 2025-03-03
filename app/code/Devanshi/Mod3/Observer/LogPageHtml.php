<?php

namespace Devanshi\Mod3\Observer;

use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;
use Magento\Framework\App\Response\Http as ResponseInterface;

class LogPageHtml implements ObserverInterface
{
    protected LoggerInterface $logger;
    protected ResponseInterface $response;
    public function __construct(
        LoggerInterface $logger,
        ResponseInterface $response
    ) 
    {
        $this->logger = $logger;
        $this->response = $response;
    }
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $html = $this->response->getBody();
        $this->logger->info('Page HTML: ' . substr($html, 0, 500));
    }
}