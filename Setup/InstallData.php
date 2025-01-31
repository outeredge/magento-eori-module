<?php

namespace OuterEdge\Eori\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        $connection = $installer->getConnection();
        $connection
            ->addColumn(
                $installer->getTable('quote_address'),
                'eori_number',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table ::TYPE_TEXT,
                    'nullable' => true,
                    'default' => NULL,
                    'length' => 255,
                    'comment' => 'EORI Number'
                ]
            );
        $connection
            ->addColumn(
                $installer->getTable('sales_order_address'),
                'eori_number',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table ::TYPE_TEXT,
                    'nullable' => true,
                    'default' => NULL,
                    'length' => 255,
                    'comment' => 'EORI Number'
                ]
            );

        $installer->endSetup();
    }
}
