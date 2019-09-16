<?php
/**
 * Created by PhpStorm.
 * User: Anita
 * Date: 15.9.2019.
 * Time: 00:18
 */

namespace Mastering\Faq\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table;

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
                    'nullable' => false,
                    'primary'  => true,
                    'unsigned' => true,
                ],
                'FAQ ID'
            )
            ->addColumn(
                'question',
                Table::TYPE_TEXT,
                null,
                ['nullable => false'],
                'FAQ Question'
            )
            ->addColumn(
                'answer',
                Table::TYPE_TEXT,
                null,
                [],
                'FAQ Answer'
            )
            ->addColumn(
                'cat_ids',
                Table::TYPE_TEXT,
                20,
                [],
                'FAQs Category'
            )
            ->addColumn(
                'status',
                Table::TYPE_INTEGER,
                1,
                [],
                'FAQ Status'
            )
            ->addColumn(
                'stores',
                Table::TYPE_TEXT,
                10,
                [],
                'FAQ Status'
            )
            ->setComment('FAQs');

            $installer->getConnection()->createTable($table);

        }

        $installer->endSetup();
    }
}