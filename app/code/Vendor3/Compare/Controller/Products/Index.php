<?php
namespace Vendor3\Compare\Controller\Products;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Psr\Log\LoggerInterface;

class Index extends Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var ProductRepositoryInterface
     */
    protected $productRepository;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param ProductRepositoryInterface $productRepository
     * @param LoggerInterface $logger
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        ProductRepositoryInterface $productRepository,
        LoggerInterface $logger
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->productRepository = $productRepository;
        $this->logger = $logger;
    }

    /**
     * Execute view action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $productIds = $this->getRequest()->getParam('products');
        $this->logger->debug('Product IDs received: ' . print_r($productIds, true));
        
        if (!$productIds || !is_array($productIds) || count($productIds) !== 2) {
            $this->messageManager->addErrorMessage(__('Please select exactly two products to compare.'));
            return $this->_redirect('*/');
        }

        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->set(__('Compare Products'));

        try {
            $products = [
                $this->productRepository->getById($productIds[0]),
                $this->productRepository->getById($productIds[1])
            ];
            
            if ($compareBlock = $resultPage->getLayout()->getBlock('compare.products')) {
                $compareBlock->setData('products', $products);
            }

        } catch (NoSuchEntityException $e) {
            $this->logger->error($e->getMessage());
            $this->messageManager->addErrorMessage(__('One of the products could not be found.'));
            return $this->_redirect('*/');
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            $this->messageManager->addErrorMessage(__('An error occurred while loading products for comparison.'));
            return $this->_redirect('*/');
        }

        return $resultPage;
    }
}