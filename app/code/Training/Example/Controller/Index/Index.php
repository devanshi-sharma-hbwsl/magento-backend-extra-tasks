<?php

declare(strict_types=1);

namespace Training\Example\Controller\Index;

use Magento\Framework\App\ActionInterface;
use Magento\Framework\Controller\Result\RawFactory;

class Index implements ActionInterface
{
    protected $resultRawFactory;
    

    public function __construct(RawFactory $resultRawFactory)
    {
        $this->resultRawFactory = $resultRawFactory;
    }

    public function execute()
    {
        return $this->resultRawFactory->create()->setContents('Example');
    }
}