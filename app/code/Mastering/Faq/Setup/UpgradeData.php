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
use Magento\Framework\File\Csv;
use Magento\Framework\App\Filesystem\DirectoryList;

/**
 * Class UpgradeData
 * @package Mastering\Faq\Setup
 */
class UpgradeData implements UpgradeDataInterface
{
    /**
     * @var Csv
     */
    protected $csvProcessor;

    /**
     * @var DirectoryList
     */
    private $directoryList;

    /**
     * UpgradeData constructor.
     * @param Csv $csvProcessor
     * @param DirectoryList $directoryList
     */
    public function __construct(
        Csv $csvProcessor,
        DirectoryList $directoryList
    )
    {
        $this->csvProcessor = $csvProcessor;
        $this->directoryList = $directoryList;
    }


    public function upgrade( ModuleDataSetupInterface $setup, ModuleContextInterface $context ) {
        $installer = $setup;
        $installer->startSetup();


        if (version_compare($context->getVersion(), '1.0.1', '<')) {
            /**
             * AdapterInterface
             */
            $installer->getConnection();
            $tableName = $installer->getTable('mastering_faq_categories');
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

        if (version_compare($context->getVersion(), '1.0.2', '<')) {

            $app = $this->directoryList->getPath('app');
            $faqsFileName = '/code/Mastering/Faq/data/faqs.csv';
            $categoriesFileName = '/code/Mastering/Faq/data/faq_categories.csv';

            //Insert faq categories
            $data = [];
            $columns = ['category_id', 'name', 'status'];
            $importRawData = $this->csvProcessor->getData($app . $categoriesFileName);

            foreach ($importRawData as $rowIndex => $dataRow) {
                if (isset($dataRow) && $dataRow != '') {
                    $data[] = $dataRow;
                }
            }

            $installer->getConnection()
                ->insertArray($installer->getTable('mastering_faq_categories'), $columns, $data);

            //Insert faq items
            $data = [];
            $columns = ['faq_id', 'question', 'answer', 'status', 'category_ids', 'store_ids'];
            $importRawData = $this->csvProcessor->getData($app . $faqsFileName);

            foreach ($importRawData as $rowIndex => $dataRow) {
                if (isset($dataRow) && $dataRow != '') {
                    $data[] = $dataRow;
                }
            }

            $installer->getConnection()
                ->insertArray($setup->getTable('mastering_faq'), $columns, $data);

        }

        if (version_compare($context->getVersion(), '1.0.3', '<')) {
            /**
             * AdapterInterface
             */
            $installer->getConnection();
            $tableName = $installer->getTable('mastering_faq_categories');
            $data = [
                [
                    'name' => 'CAT7',
                    'status' => 1
                ],
                [
                    'name' => 'CAT8',
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