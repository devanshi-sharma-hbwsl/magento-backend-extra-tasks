<?php
namespace Vendor5\Featured\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Framework\Escaper;

class HtmlFilter implements ArgumentInterface
{
    protected $escaper;
    
    protected $allowedTags = ['b', 'i', 'strong', 'em', 'a'];

    public function __construct(
        Escaper $escaper
    ) {
        $this->escaper = $escaper;
    }

    /**
     * Filter HTML content allowing only specific tags
     */
    public function filter($html): string
    {
        if (empty($html)) {
            return '';
        }

        // First escape all HTML
        $escaped = $this->escaper->escapeHtml($html);
        
        // Then allow specific tags
        return strip_tags($escaped, '<' . implode('><', $this->allowedTags) . '>');
    }
}