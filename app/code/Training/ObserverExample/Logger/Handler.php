<?php 
namespace Training\ObserverExample\Logger;

use Magento\Framework\Logger\Handler\Base;

class Handler extends Base{
    protected $loggerType = Logger::INFO;
    protected $fileName = '/var/log/custom_event.log';
}