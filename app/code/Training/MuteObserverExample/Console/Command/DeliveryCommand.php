<?php

declare(strict_types=1);

namespace Training\MuteObserverExample\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Training\MuteObserverExample\Model\DeliveryTypes;

class DeliveryCommand extends Command
{
    /**
     * @var DeliveryTypes
     */
    protected DeliveryTypes $deliveryTypes;

    /**
     * DeliveryCommand constructor.
     *
     * @param DeliveryTypes $deliveryTypes
     */
    public function __construct(DeliveryTypes $deliveryTypes)
    {
        parent::__construct(null);
        $this->deliveryTypes = $deliveryTypes;
    }
}
