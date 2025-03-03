<?php

namespace Devanshi\Mod1;

use Devanshi\Mod1\Api\CategoryInterface;
use Psr\Log\LoggerInterface;
use InvalidArgumentException;

class TestClass
{
    private CategoryInterface $category;
    private array $params;
    private string $message;
    private LoggerInterface $logger;

    public function __construct(
        CategoryInterface $category,
        LoggerInterface $logger,
        array $params = [],
        string $message = ''
    ) {
        if (!$category instanceof CategoryInterface) {
            throw new InvalidArgumentException("Hey Devanshi, you provided Invalid CategoryInterface implementation.");
        }

        $this->category = $category;
        $this->params = $params;
        $this->message = $message;
        $this->logger = $logger;
    }

    public function displayParams(): void
    {
        $jsonParams = json_encode($this->params, JSON_PRETTY_PRINT);
        $this->logger->info("Devanshi's Serialized Params: " . $jsonParams);

        echo "Devanshi's Category Data: " . $this->category->getCategoryName() . "<br>";
        echo "Devanshi's Array Params (Logged as JSON): " . $jsonParams . "<br>";
        echo "Devanshi's Message: " . $this->message . "<br>";
    }
}
