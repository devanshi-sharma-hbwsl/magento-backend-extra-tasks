<?php
namespace Devanshi\CustomSalesOrders\Controller\Adminhtml\Order;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    protected $resultPageFactory;

    public function __construct(Action\Context $context, PageFactory $resultPageFactory)
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Devanshi_CustomSalesOrders::customsalesorders');
        $resultPage->getConfig()->getTitle()->prepend(__('Custom Sales Orders'));
        return $resultPage;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Devanshi_CustomSalesOrders::customsalesorders');
    }
}
