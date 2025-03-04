<?php
declare(strict_types=1);

namespace Devanshi\Mod8\Controller\Index;

use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\Request\Http;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\Message\ManagerInterface;
use Devanshi\Mod8\Model\EmployeeFactory;
use Devanshi\Mod8\Model\ResourceModel\Employee as EmployeeResource;

class Save implements HttpPostActionInterface
{
    private EmployeeFactory $employeeFactory;
    private EmployeeResource $employeeResource;
    private ManagerInterface $messageManager;
    private RedirectFactory $redirectFactory;
    private Http $request;

    public function __construct(
        EmployeeFactory $employeeFactory,
        EmployeeResource $employeeResource,
        ManagerInterface $messageManager,
        RedirectFactory $redirectFactory,
        Http $request
    ) {
        $this->employeeFactory = $employeeFactory;
        $this->employeeResource = $employeeResource;
        $this->messageManager = $messageManager;
        $this->redirectFactory = $redirectFactory;
        $this->request = $request;
    }

    public function execute(): Redirect
    {
        $data = $this->request->getPostValue();

        if ($data) {
            try {
                $employee = $this->employeeFactory->create();
                $employee->setFirstName($data['first_name']);
                $employee->setLastName($data['last_name']);
                $employee->setEmailId($data['email_id']);

                $this->employeeResource->save($employee);

                $this->messageManager->addSuccessMessage(__('Employee saved successfully!'));
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('Error: ' . $e->getMessage()));
            }
        } else {
            $this->messageManager->addErrorMessage(__('Devanshi - Invalid data submitted.'));
        }

        return $this->redirectFactory->create()->setPath('mod8/index/index');
    }
}
