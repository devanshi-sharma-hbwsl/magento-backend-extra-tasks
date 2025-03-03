<?php

declare(strict_types=1);

namespace Training\PoolPattern\ViewModel;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class Example implements ArgumentInterface
{
    public function getCode(RequestInterface $request): string
    {
        $code = (string) $request->getParam('code');

        if ($code === '') {
            throw new \InvalidArgumentException('Code can not be empty.');
        }

        if (strlen($code) > 10) {
            throw new \InvalidArgumentException('Code must not be more than 10 characters');
        }

        if (!ctype_alnum($code)) {
            throw new \InvalidArgumentException('Code must only contain alphanumeric characters.');
        }

        return $code;
    }
}
