<?php 

namespace Training\PluginExample\ViewModel;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Training\PluginExample\Model\ProductKey;

class Example implements ArgumentInterface{
     
    protected ProductRepositoryInterface $productRepository;
    protected ProductKey $productKey;
    public function __construct(ProductRepositoryInterface $productRepository,ProductKey $productKey){
        $this->productRepository = $productRepository;
        $this->productKey = $productKey;
    }
    public function getProductKey(RequestInterface $request){
        $productId=$request->getParam('product_id');
        return $productId.'-devanshi';
    }

}