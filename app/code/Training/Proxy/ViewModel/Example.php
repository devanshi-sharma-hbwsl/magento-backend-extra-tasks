<?php

namespace Training\Proxy\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Training\Proxy\Model\FeaturedProducts;

class Example implements ArgumentInterface
{
    protected FeaturedProducts $featuredProducts;

    public function __construct(FeaturedProducts $featuredProducts)
    {
        $this->featuredProducts = $featuredProducts;
    }

    public function getFeaturedProducts() : array
    {
        return $this->featuredProducts->getFeaturedProds();
    }
}