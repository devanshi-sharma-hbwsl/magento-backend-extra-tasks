<?php 
namespace Training\PluginExample\Plugin;

use Magento\Catalog\Api\Data\ProductInterface;
class ProductKeyPlugin{
    public function __construct(){

    }
    public function beforeGetKey(\Training\PluginExample\Model\ProductKey $subject,ProductInterface $product,string $prefix){
      $product= $product->getId()."_".$prefix;
      return [$product,$prefix];
    }
    public function afterGetKey(\Training\PluginExample\Model\ProductKey $subject,ProductInterface $product,string $prefix){
        $product= $product->getId()."_".$prefix;
        return $product;
    }
}