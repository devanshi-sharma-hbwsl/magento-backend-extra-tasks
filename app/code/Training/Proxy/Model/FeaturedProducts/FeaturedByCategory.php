<?php

namespace Training\Proxy\Model\FeaturedProducts;
use Training\Proxy\Model\FeaturedProducts\FeaturedProductsInterface;

class FeaturedByCategory implements FeaturedProductsInterface
{
    
    protected array $featuredProducts;

    public function __construct()
    {
        $this->loadFeaturedProducts();
    }

    public function getFeaturedProducts() : array
    {
        return $this->featuredProducts;
    }

    public function count() : int {
        return count($this->featuredProducts);
    }

    public function loadFeaturedProducts() : void
    {
        $this->featuredProducts = [
            'prod_1',
            'prod_2',
            'prod_3',
            'prod_4',
            // 'prod_5',
            // 'prod_6',
            // 'prod_7',
        ];
    }
}