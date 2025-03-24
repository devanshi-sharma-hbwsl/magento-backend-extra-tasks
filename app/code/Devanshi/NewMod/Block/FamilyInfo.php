<?php
namespace Devanshi\NewMod\Block;

use Magento\Framework\View\Element\Template;
use Magento\Customer\Model\Session;
use Devanshi\SpouseChildren\Model\ResourceModel\FamilyInfo\CollectionFactory;
use Magento\Customer\Api\CustomerRepositoryInterface;

class FamilyInfo extends Template
{
    protected $customerSession;
    protected $familyInfoCollectionFactory;
    protected $customerRepository;

    public function __construct(
        Template\Context $context,
        CollectionFactory $familyInfoCollectionFactory,
        Session $customerSession,
        CustomerRepositoryInterface $customerRepository,
        array $data = []
    ) {
        $this->familyInfoCollectionFactory = $familyInfoCollectionFactory;
        $this->customerSession = $customerSession;
        parent::__construct($context, $data);
        $this->customerRepository = $customerRepository;
    }

    public function getFamilyInfo()
    {
        $customerId = $this->customerSession->getCustomerId();

        if (!$customerId) {
            return null;
        }

        $familyInfo = $this->familyInfoCollectionFactory->create()
            ->addFieldToFilter('customer_id', $customerId)
            ->getFirstItem();

        return $familyInfo->getData();
    }

    public function getSpouseName()
    {
        // $familyInfo = $this->getFamilyInfo();
        // return $familyInfo['spouse_name'] ?? '';

        if ($this->customerSession->isLoggedIn()) {
            $customer = $this->customerRepository->getById($this->customerSession->getCustomerId());
            return $customer->getCustomAttribute('spouse_name') ? $customer->getCustomAttribute('spouse_name')->getValue() : 'nill';
        }
        return 'nill';
    }

    public function getChildrenName()
    {
        // $familyInfo = $this->getFamilyInfo();
        // return $familyInfo['children_name'] ?? '';

        if ($this->customerSession->isLoggedIn()) {
            $customer = $this->customerRepository->getById($this->customerSession->getCustomerId());
            return $customer->getCustomAttribute('children_name') ? $customer->getCustomAttribute('children_name')->getValue() : 'nill';
        }
        return 'nill';
    }

    public function getExternalId()
    {
        if ($this->customerSession->isLoggedIn()) {
            return $this->customerSession->getCustomer()->getExternalcorpExternalId();
        }
        return null;
    }
}
