<?php

namespace Devanshi\Mod6\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\LayoutFactory;
class Display implements HttpGetActionInterface
{
    protected $layoutFactory;
    protected $resultFactory;

    public function __construct(
        LayoutFactory $layoutFactory,
        ResultFactory $resultFactory
    ) 
    {
        $this->layoutFactory = $layoutFactory;
        $this->resultFactory = $resultFactory;
    }
    public function execute()
    {
        $layout = $this->layoutFactory->create();
        $block = $layout->createBlock(\Devanshi\Mod6\Block\CustomBlock::class);

        $resultRaw = $this->resultFactory->create(ResultFactory::TYPE_RAW);
        $resultRaw->setContents($block->toHtml());

        return $resultRaw;
    }
}
?>
