<?php

declare(strict_types=1);

namespace Training\LayoutRemoveExample\Plugin;

use Magento\Framework\App\RequestInterface;

class RenderCustomerNew
{
    protected $request;

    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
    }
}