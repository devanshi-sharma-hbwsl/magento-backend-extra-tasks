<?php
declare (strict_types=1);

namespace MageMastery\Popup\ViewModel;

use MageMastery\Popup\Api\Data\PopupInterface;
use MageMastery\Popup\Api\PopupManagementInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class PopupViewModel implements ArgumentInterface
{
    private PopupManagementInterface $popupManagement;

    public function __construct(
        PopupManagementInterface $popupManagement
    ) {
        $this->popupManagement = $popupManagement;
    }
    public function getPopup(): PopupInterface
    {
        return $this->popupManagement->getApplicablePopup();

    }
}