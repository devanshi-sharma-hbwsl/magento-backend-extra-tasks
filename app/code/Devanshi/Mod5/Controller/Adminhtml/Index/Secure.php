<?php
namespace Devanshi\Mod5\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;

class Secure extends Action
{
    public function __construct(Context $context)
    {
        parent::__construct($context);
    }

    public function execute()
    {
        $access = $this->getRequest()->getParam('access');

        if ($access !== 'true') {
            $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            $resultRedirect->setUrl($this->_redirect->getRefererUrl());
            $this->messageManager->addErrorMessage('Access Denied! Add ?access=true to the URL.');
            return $resultRedirect;
        }
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_RAW);
        $resultPage->setContents("Admin Access Granted!");
        return $resultPage;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Devanshi_Mod5::secure');
    }
}
