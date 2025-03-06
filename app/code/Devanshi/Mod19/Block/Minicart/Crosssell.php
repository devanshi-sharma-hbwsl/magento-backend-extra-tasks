<?php
namespace Devanshi\Mod19\Block\Minicart;

use Magento\Catalog\Api\Data\ProductLinkInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Checkout\Block\Cart\Sidebar;
use Magento\Framework\View\Element\Template;
use Psr\Log\LoggerInterface;

class Crosssell extends Template
{
    protected $productRepository;
    protected $cart;
    protected $logger;

    public function __construct(
        Template\Context $context,
        ProductRepositoryInterface $productRepository,
        Sidebar $cart,
        LoggerInterface $logger,
        array $data = []
    ) {
        $this->productRepository = $productRepository;
        $this->cart = $cart;
        $this->logger = $logger;
        parent::__construct($context, $data);
    }

    public function getCrossSellProducts()
    {
        $this->logger->info('Fetching cross-sell products...');
        
        $items = $this->cart->getQuote()->getAllItems();
        if (empty($items)) {
            $this->logger->info('No items in cart.');
            return [];
        }

        $crossSellProducts = [];
        foreach ($items as $item) {
            try {
                $productSku = $item->getProduct()->getSku();
                $product = $this->productRepository->get($productSku);
                
                $linkedProducts = $product->getProductLinks();
                foreach ($linkedProducts as $link) {
                    if ($link->getLinkType() === 'crosssell') {
                        $linkedProductSku = $link->getLinkedProductSku();
                        $linkedProduct = $this->productRepository->get($linkedProductSku);
                        $crossSellProducts[] = $linkedProduct;
                        $this->logger->info('Cross-sell product: ' . $linkedProduct->getName());
                    }
                }
            } catch (\Exception $e) {
                $this->logger->error('Error processing cart item: ' . $item->getName(), [
                    'exception' => $e->getMessage()
                ]);
            }
        }

        $this->logger->info('Finished fetching cross-sell products.');
        return $crossSellProducts;
    }

    public function getImageUrl($product)
    {
        return $this->_urlBuilder->getBaseUrl() . 'pub/media/catalog/product' . $product->getImage();
    }
}
