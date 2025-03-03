<?php

declare(strict_types=1);

namespace Devanshi\Mod1\Logger;

use Monolog\Logger;
use Magento\Framework\Logger\Handler\Base;

class Handler extends Base
{
    protected $fileName = '/var/log/custom_test.log';
    protected $loggerType = Logger::INFO;
}
