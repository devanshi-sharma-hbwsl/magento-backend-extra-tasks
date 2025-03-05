<?php

namespace Devanshi\Mod16\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\View\Element\Template\Context;

class Colorpicker extends Template
{
    protected $scopeConfig;
    public function __construct(
        Context $context,
        ScopeConfigInterface $scopeConfig,
        array $data = []
    ) {
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context, $data);
    }

    public function getBackgroundColor()
    {
        return $this->scopeConfig->getValue(
            'mod16/general/page_color',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
}
?>