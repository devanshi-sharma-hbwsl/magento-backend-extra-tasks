<?php
declare(strict_types=1);
namespace MageMastery\Popup\Block\Adminhtml\Popup\Edit;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\UrlInterface;
class GenericButton
{
    /**
     * @var UrlInterface
     */
    private $url;

    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * Constructor
     *
     * @param UrlInterface $url
     * @param RequestInterface $request
     */
    public function __construct(
        UrlInterface $url,
        RequestInterface $request
    ) {
        $this->url = $url;
        $this->request = $request; // Properly assign the request
    }

    /**
     * Return Popup ID
     *
     * @return int|null
     */
    public function getPopupId(): int
    {
        return (int)$this->request->getParam('popup_id', 0);
    }

    /**
     * Generate URL by route and parameters
     *
     * @param string $route
     * @param array $params
     * @return string
     */
    public function getUrl(string $route = '', array $params = []): string
    {
        return $this->url->getUrl($route, $params);
    }
}
