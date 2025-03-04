<?php

namespace Devanshi\Mod7\Block;

use Magento\Framework\View\Element\Template;

class Message extends Template
{
    protected function _afterToHtml($html)
    {
        return $html . '<div>Hey Devanshi, This is an additional message rendered via _afterToHtml()</div>';
    }
}
