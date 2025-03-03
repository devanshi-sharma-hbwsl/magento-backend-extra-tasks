<?php

namespace Devanshi\Mod1\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\Result\Raw;
use Magento\Framework\Controller\ResultFactory;
use Devanshi\Mod1\TestClass;

class Test implements HttpGetActionInterface
{
    private TestClass $test;
    private ResultFactory $resultFactory;


    public function __construct(
        TestClass $test,
        ResultFactory $resultFactory
    ) {
        $this->test = $test;
        $this->resultFactory = $resultFactory;
    }

    public function execute()
    {
        ob_start();
        $this->test->displayParams();
        $output = ob_get_clean();

        /** @var Raw $result */
        $result = $this->resultFactory->create(ResultFactory::TYPE_RAW);
        $result->setContents($output); 
        return $result;
    }
}
