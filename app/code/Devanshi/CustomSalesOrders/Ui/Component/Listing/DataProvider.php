<?php
namespace Devanshi\CustomSalesOrders\Ui\Component\Listing;

use Magento\Framework\View\Element\UiComponent\DataProvider\DataProvider as UiDataProvider;
use Magento\Sales\Model\ResourceModel\Order\CollectionFactory;

class DataProvider extends UiDataProvider
{
    protected $collection;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        \Magento\Framework\Api\Search\ReportingInterface $reporting,
        \Magento\Framework\Api\Search\SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Framework\App\RequestInterface $request,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        $this->collection->getSelect()->joinLeft(
            ['o' => $this->collection->getTable('sales_order')],
            'main_table.entity_id = o.entity_id',
            ['customer_firstname']
        );
        parent::__construct($name, $primaryFieldName, $requestFieldName, $reporting, $searchCriteriaBuilder, $request, $meta, $data);
    }

    public function getCollection()
    {
        return $this->collection;
    }
}
