<?php
namespace Devanshi\Mod2\Plugin;

use Magento\Theme\Block\Html\Footer;
class CopyrightPlugin
{
    public function afterGetCopyright(Footer $subject, string $result)
    {
        return "Custom Copyright Text - Devanshi";
    }
}
