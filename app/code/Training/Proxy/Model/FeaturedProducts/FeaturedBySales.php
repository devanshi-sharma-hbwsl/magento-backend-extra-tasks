<?php

namespace Training\Proxy\Model\FeaturedProducts;

use Training\Proxy\Model\FeaturedProducts\FeaturedProductsInterface;

class FeaturedBySales implements FeaturedProductsInterface
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

    public function count() : int
    {
        return count($this->featuredProducts);
    }

    public function loadFeaturedProducts() : void
    {
        $this->featuredProducts = [
            'sale_prod_1',
            'sale_prod_2',
            'sale_prod_3',
            'sale_prod_4',
            'sale_prod_5',
            'sale_prod_6',
            'sale_prod_7',
        ];
    }
}