<?php

declare(strict_types=1);

namespace Vendor2\Textfield\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class AddToCartObserver implements ObserverInterface
{
    public function execute(Observer $observer)
    {
        $request = $observer->getRequest();
        $product = $observer->getProduct();
        
        // Get from form data first, then fallback to direct param
        $customText = $request->getParam('custom_text') 
                     ?: ($request->getProductConfig()['custom_text'] ?? null);
        
        if ($customText) {
            $additionalOptions = [
                [
                    'label' => 'Custom Message',
                    'value' => $customText
                ]
            ];
            
            // Add to both buy request and product options
            $request->setParam('custom_text', $customText);
            $product->addCustomOption('additional_options', json_encode($additionalOptions));
            $product->addCustomOption('custom_text', $customText);
        }
    }
}