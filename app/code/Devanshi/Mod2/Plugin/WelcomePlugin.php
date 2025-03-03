<?php
namespace Devanshi\Mod2\Plugin;

class WelcomePlugin
{
    public function afterGetWelcome(\Magento\Theme\Block\Html\Header $subject, $result)
    {
        return "Welcome to Devanshi's Store!";
    }
}
