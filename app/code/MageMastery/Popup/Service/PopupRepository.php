<?php
declare (strict_types=1);

namespace MageMastery\Popup\Service;

use MageMastery\Popup\Api\Data\PopupInterface;
use MageMastery\Popup\Api\PopupRepositoryInterface;
use MageMastery\Popup\Model\PopupFactory;
use MageMastery\Popup\Model\ResourceModel\Popup as PopupResource;
use Magento\Framework\Exception\NoSuchEntityException;

class PopupRepository implements PopupRepositoryInterface
{
    /**
     * @var PopupResource
     */
    private $resource;

    /**
     * @var PopupFactory
     */
    private $factory;

    /**
     * PopupRepository constructor.
     * @param PopupResource $resource
     * @param PopupFactory $factory
     */
    public function __construct(
        PopupResource $resource,
        PopupFactory $factory
    ) {
        $this->resource = $resource;
        $this->factory = $factory;
    }

    /**
     * Save a popup.
     * 
     * @param PopupInterface $popup
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(PopupInterface $popup): void
    {
        $this->resource->save($popup);
    }

    /**
     * Delete a popup.
     * 
     * @param PopupInterface $popup
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(PopupInterface $popup): void
    {
        $this->resource->delete($popup);
    }

    /**
     * Get popup by ID.
     * 
     * @param int $popupId
     * @return PopupInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $popupId): PopupInterface
    {
        $popup = $this->factory->create();
        $this->resource->load($popup, $popupId);
        if (!$popup->getId()) {
            throw new NoSuchEntityException(
                __('The Popup with Id %1 does not exist.', $popupId)
            );
        }
        return $popup;
    }
}
