<?php 
namespace Training\PluginExample\Model;

use Magento\Catalog\Api\Data\ProductInterface;

class ProductKey{
    public function getKey(ProductInterface $product,string $prefix):string{
        return sprintf('%s:%s',$prefix,$product->getSku());
    }
}