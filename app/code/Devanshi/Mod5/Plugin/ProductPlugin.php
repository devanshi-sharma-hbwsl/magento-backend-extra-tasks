<?php
namespace Devanshi\Mod5\Plugin;

use Magento\Catalog\Block\Product\View;

class ProductPlugin
{
    public function afterToHtml(View $subject, $result)
    {
        return $result . '<p style="color: red; font-weight: bold;">[Modified by Devanshi_Mod5 Plugin]</p>';
    }
}
