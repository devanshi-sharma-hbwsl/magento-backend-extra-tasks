<?php
declare(strict_types=1);

namespace MageMastery\Popup\Controller\Adminhtml\Popup;

use MageMastery\Popup\Api\PopupRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class Edit extends Action
{
    /**
     * @var PopupRepositoryInterface
     */
    private $popupRepository;

    /**
     * @var DataPersistorInterface
     */
    private $dataPersistor;

    public function __construct(
        Context $context,
        PopupRepositoryInterface $popupRepository,
        DataPersistorInterface $dataPersistor
    ) {
        parent::__construct($context);
        $this->popupRepository = $popupRepository;
        $this->dataPersistor = $dataPersistor;
    }

    public function execute(): ResultInterface
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $popupId = (int)$this->getRequest()->getParam('popup_id');
        
        try {
            if ($popupId) {
                $popup = $this->popupRepository->getById($popupId);
                $this->dataPersistor->set('magemastery_popup_popup', $popup->getData());
                $resultPage->getConfig()->getTitle()->prepend($popup->getName());
            } else {
                $resultPage->getConfig()->getTitle()->prepend(__('New Popup'));
            }

            $resultPage->setActiveMenu('MageMastery_Popup::popup');
            $resultPage->addBreadcrumb(__('Popups'), __('Popups'));
            $resultPage->addBreadcrumb(
                $popupId ? __('Edit Popup') : __('New Popup'),
                $popupId ? __('Edit Popup') : __('New Popup')
            );
        } catch (NoSuchEntityException $exception) {
            $this->messageManager->addErrorMessage(__('The popup with the given ID does not exist.'));
            return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('*/*/');
        } catch (\Exception $exception) {
            $this->messageManager->addErrorMessage(__('An error occurred while loading the popup.'));
            return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('*/*/');
        }

        return $resultPage;
    }
}
