<?php
/**
 * Author: Mage eComm
 * Copyright © Mage eComm. All rights reserved.
 */

namespace Mastering\SampleModule\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;


class InstallData implements InstallDataInterface
{
    /**
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {

        $installer = $setup;

        $installer->startSetup();

        $installer->getConnection()->insert(
            $installer->getTable('mastering_sample_item'),
            [
                'name' => 'Item 1'
            ]
        );

        $installer->getConnection()->insert(
            $installer->getTable('mastering_sample_item'),
            [
                'name' => 'Item 2'
            ]
        );

        $installer->endSetup();
    }
}