<?php

namespace Devanshi\Mod4\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\App\ResponseFactory;
use Magento\Framework\UrlInterface;
use Magento\Framework\Message\ManagerInterface;
use Psr\Log\LoggerInterface;

class Redirect404 implements ObserverInterface
{
    protected $responseFactory;
    protected $url;
    protected $logger;
    public function __construct(
        ResponseFactory $responseFactory,
        UrlInterface $url,
        LoggerInterface $logger
    ) 
    {
        $this->responseFactory = $responseFactory;
        $this->url = $url;
        $this->logger = $logger;
    }
    public function execute(Observer $observer)
    {
        try 
        {
            $response = $observer->getEvent()->getResponse();
            if ($response && $response->getStatusCode() === 404) 
            {
                $this->logger->info('404 detected, redirecting to the contact page.');
                $customRedirectURL = $this->url->getUrl('contact');
                $this->responseFactory->create()->setRedirect($customRedirectURL)->sendResponse();
                exit; 
            }
        } 
        catch (\Exception $e) 
        {
            $this->logger->error('Error in Redirect404 Observer: ' . $e->getMessage());
        }
    }
}

