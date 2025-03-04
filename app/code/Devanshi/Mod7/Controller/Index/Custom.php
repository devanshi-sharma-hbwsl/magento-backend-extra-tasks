<?php
namespace Devanshi\Mod7\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use \Magento\Framework\View\Result\PageFactory;

class Custom implements HttpGetActionInterface
{
    protected $resultPageFactory;

    public function __construct(
        Context $context, 
        PageFactory $resultPageFactory)
    {
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->set(__('Devanshi has a Custom Page'));
        return $resultPage;
    }
}