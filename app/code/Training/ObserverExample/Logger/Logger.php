<?php 
namespace Training\ObserverExample\Logger;

use Monolog\Logger as Log;
use Magento\Framework\Logger\Handler\Base;

class Logger extends Log {
    public function __construct(
        string $name,
        \Training\ObserverExample\Logger\Handler $handler
    ) {
        parent::__construct($name, [$handler]);
    }
    public function info($message, array $context = []): void {
        $this->log(Logger::INFO, $message, $context);
    }
}