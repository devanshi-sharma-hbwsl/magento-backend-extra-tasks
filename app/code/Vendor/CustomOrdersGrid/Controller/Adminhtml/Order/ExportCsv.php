<?php
namespace Vendor\CustomOrdersGrid\Controller\Adminhtml\Order;

use Magento\Framework\App\ResponseInterface;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\App\Response\Http\FileFactory;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Ui\Component\MassAction\Filter;
use Vendor\CustomOrdersGrid\Model\ResourceModel\Order\CollectionFactory;

class ExportCsv extends \Magento\Backend\App\Action
{
    protected $fileFactory;
    protected $filter;
    protected $collectionFactory;

    public function __construct(
        Context $context,
        FileFactory $fileFactory,
        Filter $filter,
        CollectionFactory $collectionFactory
    ) {
        $this->fileFactory = $fileFactory;
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $collection = $this->collectionFactory->create();
        $collection->getSelect()->from(
            ['main_table' => $collection->getMainTable()],
            ['increment_id', 'customer_name', 'created_at', 'grand_total']
        );

        // Apply filters if any
        $this->filter->getCollection($collection);

        $csv = '';
        $headers = ['Order ID', 'Customer Name', 'Created At', 'Grand Total'];
        $csv .= implode(',', $headers) . "\n";
        
        foreach ($collection as $order) {
            $csv .= '"' . $order->getIncrementId() . '","' . 
                    $order->getCustomerName() . '","' . 
                    $order->getCreatedAt() . '","' . 
                    $order->getGrandTotal() . '"' . "\n";
        }
        
        return $this->fileFactory->create(
            'custom_orders_export.csv',
            [
                'type' => 'string',
                'value' => $csv,
                'rm' => true
            ],
            DirectoryList::VAR_DIR,
            'text/csv'
        );
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Vendor_CustomOrdersGrid::custom_orders');
    }
}