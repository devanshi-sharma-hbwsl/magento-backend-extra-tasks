<?php

namespace Devanshi\Mod17\Model\Layer\Filter;

use Magento\Catalog\Model\Layer\Filter\AbstractFilter;
use Magento\Framework\Exception\LocalizedException;

class Rating extends AbstractFilter
{
    protected function _getItemsData()
    {
        $data = [];
        $ratings = [5, 4, 3, 2, 1];

        foreach ($ratings as $rating) {
            $data[] = [
                'label' => __("$rating Stars"),
                'value' => $rating,
                'count' => $this->getRatingCount($rating),
            ];
        }

        return $data;
    }

    private function getRatingCount($rating)
    {
        return rand(1, 100);
    }

    protected function applyFilterToCollection($value)
    {
        if (!is_numeric($value)) {
            return $this;
        }

        $this->getLayer()
            ->getProductCollection()
            ->addAttributeToFilter('rating_summary', ['gteq' => $value * 20]);

        $this->getState()->addFilter($this->_createItem(__("$value Stars"), $value));

        return $this;
    }
}
