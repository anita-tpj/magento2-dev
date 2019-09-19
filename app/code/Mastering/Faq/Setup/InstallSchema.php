<?php
/**
 * Created by PhpStorm.
 * User: Anita
 * Date: 15.9.2019.
 * Time: 00:18
 */

namespace Mastering\Faq\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

/**
 * Class InstallSchema
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @throws \Zend_Db_Exception
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        $tableName = 'mastering_faq';
        if (!$installer->tableExists($tableName)) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable($tableName)
            )
                ->addColumn(
                    'faq_id',
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'primary'  => true,
                        'nullable' => false,
                        'unsigned' => true
                    ],
                    'FAQ ID'
                )
                ->addColumn(
                    'question',
                    Table::TYPE_TEXT,
                    null,
                    [
                        'nullable' => false,
                    ],
                    'FAQ question'
                )
                ->addColumn(
                    'answer',
                    Table::TYPE_TEXT,
                    null,
                    [
                        'nullable' => false,
                    ],
                    'FAQ answer'
                )
                ->addColumn(
                    'status',
                    Table::TYPE_INTEGER,
                    1,
                    [
                        'nullable' => false,
                    ],
                    'FAQ status'
                )
                ->addColumn(
                    'category_ids',
                    Table::TYPE_TEXT,
                    20,
                    [
                        'nullable' => true,
                    ],
                    'FAQs category'
                )
                ->addColumn(
                    'store_ids',
                    Table::TYPE_TEXT,
                    10,
                    [
                        'nullable' => false,
                    ],
                    'Stores'
                );

            $installer->getConnection()->createTable($table);
        }
        $installer->endSetup();
    }
}