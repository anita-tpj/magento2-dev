<?php
/**
 * Author: Mage eComm
 * Copyright © Mage eComm. All rights reserved.
 */

namespace Mastering\SampleModule\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;


class InstallSchema implements InstallSchemaInterface
{
    /**
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        $table = $installer->getConnection()->newTable(
            $installer->getTable('mastering_sample_item')
        )->addColumn(
            'id',
            Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'nullable' =>false, 'primary' => true],
            'Item ID'
        )->addColumn(
            'name',
            Table:: TYPE_TEXT,
            255,
            ['nullable => false'],
            'Item Name'
        )->addIndex(
            $installer->getIdxName('mastering_sample_item', ['mane']),
            ['name']
        )->setComment(
            'Sample Items'
        );

        $installer->getConnection()->createTable($table);

        $installer->endSetup();
    }
}