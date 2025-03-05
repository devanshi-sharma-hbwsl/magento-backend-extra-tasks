<?php

namespace Devanshi\Mod9\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class Index implements HttpGetActionInterface
{
    protected $scopeConfig;
    protected $jsonFactory;

    public function __construct(
        ScopeConfigInterface $scopeConfig,
        JsonFactory $jsonFactory
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->jsonFactory = $jsonFactory;
    }

    public function execute()
    {
        $result = $this->jsonFactory->create();
        $isEnabled = $this->scopeConfig->isSetFlag('mod9/general/enable', ScopeInterface::SCOPE_STORE);
        $textToDisplay = $this->scopeConfig->getValue('mod9/general/text_to_display', ScopeInterface::SCOPE_STORE);

        if ($isEnabled) {
            $data = ['message' => "Hey Devanshi, This Message is From admin panel: " . $textToDisplay];
        } else {
            $data = ['message' => "Hey Devanshi, The feature is currently disabled."];
        }

        return $result->setData($data);
    }
}
