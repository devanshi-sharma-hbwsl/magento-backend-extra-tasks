<?php
namespace Devanshi\Mod20\Plugin;

use Magento\Catalog\Model\Product;
use Magento\Framework\UrlInterface;
use Psr\Log\LoggerInterface;
use Magento\InventorySalesApi\Api\GetProductSalableQtyInterface;

class ProductListPlugin
{
    protected $urlBuilder;
    protected $logger;
    protected $getProductSalableQty;
    public function __construct(
        UrlInterface $urlBuilder,
        LoggerInterface $logger,
        GetProductSalableQtyInterface $getProductSalableQty
    ) {
        $this->urlBuilder = $urlBuilder;
        $this->logger = $logger;
        $this->getProductSalableQty = $getProductSalableQty;
    }
    public function afterGetAddToCartUrl($subject, $result, Product $product)
    {
        $salableQty = $this->getSalableQuantity($product);
        $this->logger->info('Product salable qty on PLP: ' . $salableQty);
        if ($salableQty <= 0) {
            return $this->urlBuilder->getUrl('contact');
        }
        return $result;
    }

    private function getSalableQuantity(Product $product)
    {
        $sku = $product->getSku();
        $stockId = 1; 
        return $this->getProductSalableQty->execute($sku, $stockId);
    }
}
