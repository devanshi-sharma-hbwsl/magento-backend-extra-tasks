<?php

declare(strict_types=1);

namespace Training\ViewModelExample\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;

class DeliveryMessage implements ArgumentInterface 
{
    public function getMessage()
    {
        return "devanshi sharma is here from view model";
    }
}