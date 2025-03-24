<?php
declare(strict_types=1);

namespace MageMastery\Popup\Controller\Adminhtml\Popup;

use MageMastery\Popup\Api\PopupRepositoryInterface;
use MageMastery\Popup\Model\ResourceModel\Popup\CollectionFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Psr\Log\LoggerInterface;

class InlineEdit extends Action
{
    private $collectionFactory;
    private $popupRepository;
    private $logger;

    public function __construct(
        Context $context,
        CollectionFactory $collectionFactory,
        PopupRepositoryInterface $popupRepository,
        LoggerInterface $logger
    ) {
        parent::__construct($context);

        // Assign dependencies to class properties
        $this->collectionFactory = $collectionFactory;
        $this->popupRepository = $popupRepository;
        $this->logger = $logger;
    }

    public function execute(): ResultInterface
    {
        $result = $this->resultFactory->create(ResultFactory::TYPE_JSON);

        // Get items from the request
        $items = $this->getRequest()->getParam('items', []);
        $messages = [];
        $hasError = false;

        if (empty($items)) {
            $messages[] = __('No data provided for update. Please check and try again.');
            $hasError = true;
        } else {
            foreach ($items as $popupId => $popupData) {
                try {
                    $popup = $this->popupRepository->getById((int)$popupId);
                    $popup->addData($popupData); // Simplified updating of popup data
                    $this->popupRepository->save($popup);
                } catch (\Throwable $exception) {
                    // Log the exception for debugging
                    $this->logger->error(
                        sprintf('[Popup ID: %d] Error: %s', $popupId, $exception->getMessage())
                    );
                    $messages[] = __('Error updating Popup ID %1: %2', $popupId, $exception->getMessage());
                    $hasError = true;
                }
            }
        }

        // Set response data
        return $result->setData(
            [
                'messages' => $messages,
                'error'    => $hasError,
            ]
        );
    }
}
