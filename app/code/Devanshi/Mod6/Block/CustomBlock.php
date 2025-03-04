<?php
namespace Devanshi\Mod6\Block;
use Magento\Framework\View\Element\Template;

class CustomBlock extends Template 
{
    
    protected function _toHtml() 
    {
        return '<div>Before Html - This Message is to show that, Devanshi Knows how to use _toHtml method</div>';
    }
    protected function _afterToHtml($html) 
    {
        return $html . '<div>After Html - This Message is to show that, Devanshi Knows how to use _afterToHtml method</div>';
    }
}

?>