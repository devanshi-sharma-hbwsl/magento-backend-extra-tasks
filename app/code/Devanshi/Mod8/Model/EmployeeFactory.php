<?php
declare(strict_types=1);

namespace Devanshi\Mod8\Model;

use Magento\Framework\ObjectManagerInterface;

class EmployeeFactory
{
    private ObjectManagerInterface $objectManager;
    private string $instanceName;


    public function __construct(ObjectManagerInterface $objectManager, string $instanceName = Employee::class)
    {
        $this->objectManager = $objectManager;
        $this->instanceName = $instanceName;
    }

    public function create(array $data = []): Employee
    {
        return $this->objectManager->create($this->instanceName, $data);
    }
}
