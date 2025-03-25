<?php
/**
 * Copyright [first year code created] Adobe
 * All rights reserved.
 */

namespace Dev\Grid\Ui\DataProvider\Category\Listing;

use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;

class Collection extends SearchResult
{
    /**
     * Override _initSelect to add custom columns
     *
     * @return void
     */
    protected function _initSelect()
    {
        $this->addFilterToMap('entity_id', 'main_table.entity_id');
        $this->addFilterToMap('name', 'devgridname.value');
        parent::_initSelect();
    }
}
