<?php
declare(strict_types=1);

namespace MageMastery\Popup\Controller\Adminhtml\Popup;

use MageMastery\Popup\Api\PopupRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class Delete extends Action
{
    /**
     * @var PopupRepositoryInterface
     */
    private $popupRepository;

    public function __construct(
        Context $context,
        PopupRepositoryInterface $popupRepository
    ) {
        parent::__construct($context);
        $this->popupRepository = $popupRepository;
    }

    public function execute(): ResultInterface
    {
        $popupId = (int)$this->getRequest()->getParam('popup_id', 0);
        $result = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        if ($popupId === 0) {
            $this->messageManager->addWarningMessage(
                __('The popup ID is missing or invalid.')
            );
            return $result->setPath('magemastery_popup/popup/index');
        }

        try {
            $popup = $this->popupRepository->getById($popupId);
            $this->popupRepository->delete($popup);
            $this->messageManager->addSuccessMessage(
                __('The popup with ID %1 has been successfully deleted.', $popupId)
            );
        } catch (NoSuchEntityException $exception) {
            $this->messageManager->addErrorMessage(
                __('The popup with ID %1 does not exist.', $popupId)
            );
        } catch (\Exception $exception) {
            $this->messageManager->addErrorMessage(
                __('An error occurred while deleting the popup: %1', $exception->getMessage())
            );
        }
        return $result->setPath('magemastery_popup/popup/index');
    }
}
