<?php
/**
 * Created by PhpStorm.
 * User: Anita
 * Date: 15.9.2019.
 * Time: 00:18
 */

namespace Mastering\Faq\Setup;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class InstallData implements \Magento\Framework\Setup\InstallDataInterface
{
    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $setup->getConnection()->insert(
            $setup->getTable('mastering_faq'),
            [
                'question' => 'Question 1?'
            ]
        );

        $setup->getConnection()->insert(
            $setup->getTable('mastering_faq'),
            [
                'question' => 'Question 2?'
            ]
        );

        $setup->endSetup();
    }
}