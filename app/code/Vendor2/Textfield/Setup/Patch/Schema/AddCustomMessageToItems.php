<?php
namespace Vendor2\Textfield\Setup\Patch\Schema;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\SchemaPatchInterface;
use Magento\Framework\DB\Ddl\Table;

class AddCustomMessageToItems implements SchemaPatchInterface
{
    private $moduleDataSetup;

    public function __construct(ModuleDataSetupInterface $moduleDataSetup)
    {
        $this->moduleDataSetup = $moduleDataSetup;
    }

    public function apply()
    {
        $setup = $this->moduleDataSetup;
        $connection = $setup->getConnection();

        $setup->startSetup();

        if (!$connection->tableColumnExists($setup->getTable('quote_item'), 'custom_message')) {
            $connection->addColumn(
                $setup->getTable('quote_item'),
                'custom_message',
                [
                    'type' => Table::TYPE_TEXT,
                    'nullable' => true,
                    'comment' => 'Custom Message'
                ]
            );
        }

        if (!$connection->tableColumnExists($setup->getTable('sales_order_item'), 'custom_message')) {
            $connection->addColumn(
                $setup->getTable('sales_order_item'),
                'custom_message',
                [
                    'type' => Table::TYPE_TEXT,
                    'nullable' => true,
                    'comment' => 'Custom Message'
                ]
            );
        }

        $setup->endSetup();
    }

    public static function getDependencies() { return []; }
    public function getAliases() { return []; }
}
