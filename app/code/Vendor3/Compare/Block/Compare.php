<?php
namespace Vendor3\Compare\Block;

use Magento\Catalog\Block\Product\Context;
use Magento\Catalog\Model\Product;
use Magento\Framework\View\Element\Template;
use Magento\Catalog\Helper\Image;

class Compare extends Template
{
    /**
     * @var Image
     */
    protected $imageHelper;

    public function __construct(
        Context $context, // Changed from Template\Context to Product\Context
        Image $imageHelper,
        array $data = []
    ) {
        $this->imageHelper = $imageHelper;
        parent::__construct($context, $data);
    }

    public function getProductImageUrl(Product $product, $imageType = 'product_comparison_list')
    {
        try {
            return $this->imageHelper->init($product, $imageType)
                ->setImageFile($product->getImage())
                ->getUrl();
        } catch (\Exception $e) {
            return $this->imageHelper->getDefaultPlaceholderUrl();
        }
    }

    public function getProducts()
    {
        if (!$this->hasData('products')) {
            $productIds = $this->getRequest()->getParam('products');
            $products = [];
            
            if (is_array($productIds) && count($productIds) === 2) {
                foreach ($productIds as $id) {
                    try {
                        $products[] = $this->productRepository->getById($id);
                    } catch (\Exception $e) {
                        $this->_logger->error($e->getMessage());
                    }
                }
                $this->setData('products', $products);
            }
        }
        return $this->getData('products') ?: [];
    }
    public function getAttributesToCompare()
    {
        return [
            'image' => __('Image'),
            'name' => __('Name'),
            'price' => __('Price'),
            'sku' => __('SKU'),
            'short_description' => __('Short Description')
        ];
    }

    public function getProductAttributeValue(Product $product, $attributeCode)
    {
        switch ($attributeCode) {
            case 'image':
                return $product->getImageUrl();
            case 'price':
                return $product->getFormattedPrice();
            case 'short_description':
                return $product->getShortDescription();
            default:
                return $product->getData($attributeCode);
        }
    }

        public function getProductDetails(Product $product)
        {
            $details = [];
            
            // Get the description (if you still want to show it)
            if ($description = $product->getDescription()) {
                $details[] = $description;
            }
            
            // Add any additional details you want to show
            if ($additionalInfo = $product->getData('more_information')) {
                $details[] = $additionalInfo;
            }
            
            // Add product features if available
            if ($features = $product->getData('features')) {
                $details[] = "<ul><li>" . implode("</li><li>", explode("\n", $features)) . "</li></ul>";
            }
            
            return implode("<br>", $details);
        }
}