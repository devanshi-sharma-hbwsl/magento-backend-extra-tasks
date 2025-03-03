<?php

declare(strict_types=1);

namespace Training\InjectablesAndNonInjectablesExample\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Training\InjectablesAndNonInjectablesExample\Service\Demand;
use Training\InjectablesAndNonInjectablesExample\Service\Supply;

class Example implements ArgumentInterface
{
    protected Supply $supply;
    protected Demand $demand;

    public function __construct (Supply $supply, Demand $demand)
    {
        $this->supply = $supply;
        $this->demand = $demand;
    }

    public function getSupply()
    {
        return $this->supply;
    }

    public function getDemand()
    {
        return $this->demand;
    }
}