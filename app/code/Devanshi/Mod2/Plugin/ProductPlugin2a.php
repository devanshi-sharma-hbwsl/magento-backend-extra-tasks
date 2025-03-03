<?php

namespace Devanshi\Mod2\Plugin;

use Magento\Catalog\Model\Product;
use Magento\Framework\Pricing\PriceCurrencyInterface;

class ProductPlugin2a
{
    private PriceCurrencyInterface $priceCurrency;

    public function __construct(PriceCurrencyInterface $priceCurrency)
    {
        $this->priceCurrency = $priceCurrency;
    }

    public function afterGetName(Product $subject, string $result): string
    {
        $price = $subject->getFinalPrice();

        if ($price < 20) {
            $result .= " WholeSale !! by Devanshi";
        } elseif ($price >= 20 && $price < 50) {
            $discountedPrice = $price * 0.85; 
            $formattedPrice = $this->priceCurrency->format($discountedPrice, false);
            $result .= " Super Sale!! (Discounted Price: {$formattedPrice}) by Devanshi";
        } elseif ($price >= 50) {
            $result .= " Premium !! by Devanshi";
        }

        return $result;
    }
}
