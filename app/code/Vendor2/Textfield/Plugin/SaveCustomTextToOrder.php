<?php
namespace Vendor2\Textfield\Plugin;

class SaveCustomTextToOrder
{
    public function beforePlace(
        \Magento\Sales\Model\Order $subject
    ) {
        foreach ($subject->getAllItems() as $orderItem) {
            if ($customText = $orderItem->getData('custom_text')) {
                $orderItem->setData('custom_text', $customText);
            }
        }
        return null;
    }
}