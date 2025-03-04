<?php
namespace Devanshi\Mod8\Block;

use Magento\Framework\View\Element\Template;
use Devanshi\Mod8\Model\ResourceModel\Employee\CollectionFactory;

class Table extends Template
{
    protected $collectionFactory;

    public function __construct(Template\Context $context, CollectionFactory $collectionFactory, array $data = [])
    {
        parent::__construct($context, $data);
        $this->collectionFactory = $collectionFactory;
    }

    public function getEmployees()
    {
        return $this->collectionFactory->create()->getItems();
    }
}
