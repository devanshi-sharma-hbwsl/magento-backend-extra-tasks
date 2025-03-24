<?php
declare(strict_types=1);
namespace MageMastery\Popup\Controller\Adminhtml\Popup;

use MageMastery\Popup\Api\PopupRepositoryInterface;
use MageMastery\Popup\Model\ResourceModel\Popup\CollectionFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Ui\Component\MassAction\Filter;

class MassDelete extends Action
{
    private $filter;
    private $collectionFactory;
    private $popupRepository;

    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        PopupRepositoryInterface $popupRepository
    ) {
        parent::__construct($context);

        // Assign injected dependencies to class properties
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->popupRepository = $popupRepository;
    }

    public function execute(): ResultInterface
    {
        try {
            // Retrieve the collection of items to delete
            $collection = $this->filter->getCollection($this->collectionFactory->create());
            $collectionSize = $collection->getSize();

            // Delete each popup
            foreach ($collection as $popup) {
                $this->popupRepository->delete($popup);
            }

            // Add success message with placeholder substitution
            $this->messageManager->addSuccessMessage(
                __('A total of %1 record(s) have been deleted.', $collectionSize)
            );
        } catch (\Throwable $exception) {
            // Add error message
            $this->messageManager->addErrorMessage(
                __('Something went wrong while processing the delete operation: %1', $exception->getMessage())
            );
        }

        // Redirect to the index page
        $result = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $result->setPath('magemastery_popup/popup/index');
    }
}
