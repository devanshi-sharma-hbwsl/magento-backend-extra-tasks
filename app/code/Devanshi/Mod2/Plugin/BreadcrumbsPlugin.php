<?php
namespace Devanshi\Mod2\Plugin;

class BreadcrumbsPlugin
{
    public function beforeAddCrumb(\Magento\Theme\Block\Html\Breadcrumbs $subject, $crumbName, array $crumbInfo)
    {
        if (isset($crumbInfo['label'])) {
            $crumbInfo['label'] = 'Hummingbird Devanshi' . $crumbInfo['label'];
        }
        return [$crumbName, $crumbInfo];
    }
}
