<?php

namespace Training\Proxy\Model;

use Training\Proxy\Model\FeaturedProducts\FeaturedByCategory;
use Training\Proxy\Model\FeaturedProducts\FeaturedBySales;

class FeaturedProducts
{
    protected FeaturedByCategory $featuredByCategory;
    protected FeaturedBySales $featuredBySales;

    public function __construct(
        FeaturedByCategory $featuredByCategory, 
        FeaturedBySales $featuredBySales
    )
    {
        $this->featuredByCategory = $featuredByCategory;
        $this->featuredBySales = $featuredBySales;
    }

    public function getFeaturedProds() : array
    {
        if ($this->featuredByCategory->count() < 6) {
            return $this->featuredBySales->getFeaturedProducts();
        }

        return $this->featuredByCategory->getFeaturedProducts();
    }
}