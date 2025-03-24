<?php

namespace Devanshi\FinalMod\Block;

use Magento\Framework\View\Element\Template;
use Magento\Customer\Model\Session as CustomerSession;

class FamilyInfo extends Template
{
    /**
     * @var CustomerSession
     */
    protected $customerSession;

    public function __construct(
        Template\Context $context,
        CustomerSession $customerSession,
        array $data = []
    ) {
        $this->customerSession = $customerSession;
        $this->customerSession->start(); // Ensure session is started
        parent::__construct($context, $data);
    }

    /**
     * Check if customer is logged in
     */
    public function isLoggedIn()
    {
        return $this->customerSession->isLoggedIn();
    }

    /**
     * Get spouse name
     */
    public function getSpouseName()
    {
        if ($this->isLoggedIn()) {
            return $this->customerSession->getCustomer()->getData('spouse_name');
        }
        return null;
    }

    /**
     * Get children name
     */
    public function getChildrenName()
    {
        if ($this->isLoggedIn()) {
            return $this->customerSession->getCustomer()->getData('children_name');
        }
        return null;
    }
}
