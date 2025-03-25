<?php
namespace Vendor\CustomOrdersGrid\Controller\Adminhtml\Order;

use Magento\Framework\App\ResponseInterface;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\App\Response\Http\FileFactory;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use Vendor\CustomOrdersGrid\Model\ResourceModel\Order\CollectionFactory;
use Magento\Framework\Exception\LocalizedException;

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
        parent::__construct($context);
        $this->fileFactory = $fileFactory;
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
    }

    public function execute()
    {
        try {
            $collection = $this->filter->getCollection($this->collectionFactory->create());
            
            // Prepare CSV content
            $csv = '"Order ID","Customer Name","Created At","Grand Total"' . "\n";
            
            foreach ($collection as $order) {
                $csv .= sprintf('"%s","%s","%s","%s"' . "\n",
                    $order->getIncrementId(),
                    $order->getCustomerName(),
                    $order->getCreatedAt(),
                    $order->getGrandTotal()
                );
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
        } catch (LocalizedException $e) {
            // If no items selected, export all filtered items
            if (strpos($e->getMessage(), 'An item needs to be selected') !== false) {
                $collection = $this->collectionFactory->create();
                $collection->applyFiltersFromRequest($this->getRequest());
                
                $csv = '"Order ID","Customer Name","Created At","Grand Total"' . "\n";
                
                foreach ($collection as $order) {
                    $csv .= sprintf('"%s","%s","%s","%s"' . "\n",
                        $order->getIncrementId(),
                        $order->getCustomerName(),
                        $order->getCreatedAt(),
                        $order->getGrandTotal()
                    );
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
            throw $e;
        }
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Vendor_CustomOrdersGrid::custom_orders');
    }
}