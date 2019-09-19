<?php
/**
 * Created by PhpStorm.
 * User: Anita
 * Date: 18.9.2019.
 * Time: 22:49
 */

namespace Mastering\Faq\Model\ResourceModel\Categories;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 * @package Mastering\Faq\Model\ResourceModel\Categories
 */

class Collection extends AbstractCollection
{

    /**
     * @var string
     */
    protected $_idFieldName = 'category_id';


    protected function _construct()
    {
        $this->_init('Mastering\Faq\Model\Categories', 'Mastering\Faq\Model\ResourceModel\Categories');
    }

}