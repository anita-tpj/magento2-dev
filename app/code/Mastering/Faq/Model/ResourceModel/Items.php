<?php
/**
 * Created by PhpStorm.
 * User: Anita
 * Date: 16.9.2019.
 * Time: 14:06
 */

namespace Mastering\Faq\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Items
 * @package Mastering\Faq\Model\ResourceModel
 */
class Items extends AbstractDb
{

    protected function _construct()
    {
        $this->_init('mastering_faq', 'faq_id');
    }

}