<?php
/**
 * Created by PhpStorm.
 * User: Anita
 * Date: 15.9.2019.
 * Time: 00:18
 */

namespace Mastering\Faq\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;

/**
 * Class UpgradeData
 * @package Mastering\Faq\Setup
 */
class UpgradeData implements UpgradeDataInterface
{

    public function upgrade( ModuleDataSetupInterface $setup, ModuleContextInterface $context ) {
        $installer = $setup;
        $installer->startSetup();

        /**
         * AdapterInterface
         */
        $installer->getConnection();

        $tableName = $setup->getTable('mastering_faq_categories');
        if (version_compare($context->getVersion(), '1.0.1', '<')) {
            $data = [
                [
                    'name' => 'CAT1',
                    'status' => 1
                ],
                [
                    'name' => 'CAT2',
                    'status' => 1
                ]
            ];

            $installer->getConnection()->insertMultiple($tableName, $data);
        }
        $installer->endSetup();
    }
}

/*Example: Insert data via CRUD Model Factory*/

/*<?php
namespace Mastering\Faq\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Mastering\Faq\Model\CategoriesFactory;

class UpgradeData implements UpgradeDataInterface
{
    private $categoriesFactory;

    public function __construct(CategoriesFactory $categoriesFactory)
    {
        $this->categoriesFactory = $categoriesFactory;
    }

    public function upgrade( ModuleDataSetupInterface $setup, ModuleContextInterface $context ) {

        if (version_compare($context->getVersion(), '1.0.2', '<')) {
            $data = [
                'name' => 'CAT1',
            ];

            $this->categoriesFactory->create()->setData($data)->save();
        }
    }
}*/