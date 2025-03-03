<?php
namespace Training\Proxy\Model\FeaturedProducts;

interface FeaturedProductsInterface
{
    /**
     * Get a list of featured products.
     *
     * @return \Magento\Catalog\Api\Data\ProductInterface[]
     */
    public function getFeaturedProducts() : array;

    public function count() : int;
}