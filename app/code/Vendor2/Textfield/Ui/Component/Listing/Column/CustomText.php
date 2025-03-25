<?php
namespace Vendor2\Textfield\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

class CustomText extends Column
{
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $orderId = $item['entity_id'];
                $customText = $this->getCustomTextForOrder($orderId);
                $item[$this->getData('name')] = $customText;
            }
        }
        return $dataSource;
    }

    private function getCustomTextForOrder($orderId)
    {
        // Implement your logic to get custom text for the order
        // This is a placeholder - you'll need to query your data
        return 'Sample custom text'; // Replace with actual data retrieval
    }
}