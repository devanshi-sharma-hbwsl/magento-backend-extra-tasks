<?php
namespace Devanshi\Mod17\Block\Layer\Filter;

use Magento\LayeredNavigation\Block\Navigation\FilterRenderer;

class Rating extends FilterRenderer
{
    public function getFilterItems()
    {
        return $this->getFilter()->getItems();
    }
}
