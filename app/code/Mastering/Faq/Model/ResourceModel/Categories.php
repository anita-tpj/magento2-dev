<?php
/**
 * Created by PhpStorm.
 * User: Anita
 * Date: 18.9.2019.
 * Time: 22:49
 */

namespace Mastering\Faq\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Categories
 * @package Mastering\Faq\Model\ResourceModel
 */

class Categories extends AbstractDb
{

    protected function _construct()
    {
        $this->_init('mastering_faq_categories', 'category_id');
    }

}