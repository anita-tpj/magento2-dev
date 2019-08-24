<?php
/**
 * Author: Mage eComm
 * Copyright © Mage eComm. All rights reserved.
 */

namespace Mastering\SampleModule\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;


class UpgradeData implements UpgradeDataInterface
{
    /**
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();
        if(version_compare($context->getVersion(), '1.0.1', '<')) {
            $installer->getConnection()->update(
                $installer->getTable('mastering_sample_item'),
                [
                    'description' => 'Default description'
                ],
                $installer->getConnection()->quoteInto('id = ?', 1)

            );
        }

        $installer->endSetup();
    }
}