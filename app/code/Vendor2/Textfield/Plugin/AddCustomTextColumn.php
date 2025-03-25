<?php
namespace Vendor2\Textfield\Plugin;

class AddCustomTextColumn
{
    public function afterPrepare(
        \Magento\Sales\Ui\Component\Listing\Column\Status $subject,
        $result
    ) {
        $subject->getContext()->addComponentDefinition(
            'custom_text_column',
            [
                'component' => 'Magento_Ui/js/grid/columns/column',
                'config' => [
                    'label' => __('Custom Message'),
                    'dataType' => 'text',
                    'sortable' => false,
                    'filter' => false
                ]
            ]
        );
        return $result;
    }
}