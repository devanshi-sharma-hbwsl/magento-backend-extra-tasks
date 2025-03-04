<?php

namespace Devanshi\Mod6\Plugin;

use Magento\Catalog\Block\Product\View\Description;
use Psr\Log\LoggerInterface;

class CustomDescriptionPlugin
{
    protected $logger;
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
    public function afterToHtml(Description $subject, $result)
    {
        $this->logger->info('Sample description (Devanshi_Mod6)');
        return '<p>Sample description (Devanshi_Mod6)</p>';
    }
}

?>