<?php

namespace Devanshi\Mod3\Observer;

use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;
use Magento\Catalog\Model\ProductRepository;
use Magento\InventorySalesApi\Api\GetProductSalableQtyInterface;
use Magento\InventoryApi\Api\GetSourceItemsBySkuInterface;
use Magento\Framework\App\RequestInterface;

class LogProductDetails implements ObserverInterface
{
    protected LoggerInterface $logger;
    protected ProductRepository $productRepository;
    protected GetProductSalableQtyInterface $getProductSalableQty;
    protected GetSourceItemsBySkuInterface $getSourceItemsBySku;
    protected RequestInterface $request;

    public function __construct(
        LoggerInterface $logger,
        ProductRepository $productRepository,
        GetProductSalableQtyInterface $getProductSalableQty,
        GetSourceItemsBySkuInterface $getSourceItemsBySku,
        RequestInterface $request
    ) {
        $this->logger = $logger;
        $this->productRepository = $productRepository;
        $this->getProductSalableQty = $getProductSalableQty;
        $this->getSourceItemsBySku = $getSourceItemsBySku;
        $this->request = $request;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $product = $observer->getEvent()->getProduct();
        $sku = $product->getSku();
        $price = $product->getPrice();
        $salableQty = $this->getProductSalableQty->execute($sku, 1);
        $sourceItems = $this->getSourceItemsBySku->execute($sku);
        
        $qtyPerSource = [];
        foreach ($sourceItems as $sourceItem) {
            $qtyPerSource[$sourceItem->getSourceCode()] = $sourceItem->getQuantity();
        }
        
        $this->logger->info('Viewed Product: ' . $product->getName());
        $this->logger->info('SKU: ' . $sku);
        $this->logger->info('Price: ' . $price);
        $this->logger->info('Salable Quantity: ' . $salableQty);
        $this->logger->info('Quantity Per Source: ' . json_encode($qtyPerSource));
    }
}
