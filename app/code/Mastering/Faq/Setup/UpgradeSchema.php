<?php
/**
 * Created by PhpStorm.
 * User: Anita
 * Date: 15.9.2019.
 * Time: 00:18
 */

namespace Mastering\Faq\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;


class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        if (version_compare($context->getVersion(), '1.0.1', '<')) {
            $installer = $setup;
            $installer->startSetup();

            $table = $installer->getConnection()
                ->newTable($installer->getTable('mastering_faq_categories'))
                ->addColumn(
                    'category_id',
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'primary'  => true,
                        'nullable' => false,
                        'unsigned' => true
                    ],
                    'FAQ category ID'
                )
                ->addColumn(
                    'name',
                    Table::TYPE_TEXT,
                    255,
                    [
                        'nullable' => false,
                    ],
                    'FAQ category name'
                )
                ->addColumn(
                    'status',
                    Table::TYPE_INTEGER,
                    1,
                    [
                        'nullable' => false,
                    ],
                    'FAQ status'
                );

            $installer->getConnection()->createTable($table);
            $installer->endSetup();
        }
    }
}

