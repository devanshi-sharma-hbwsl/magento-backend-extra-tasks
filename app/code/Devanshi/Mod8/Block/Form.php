<?php
declare(strict_types=1);

namespace Devanshi\Mod8\Block;

use Magento\Framework\View\Element\Template;

class Form extends Template
{
    public function getFormAction(): string
    {
        return $this->getUrl('mod8/index/save'); 
    }
}
