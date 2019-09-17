<?php
/**
 * Created by PhpStorm.
 * User: Anita
 * Date: 16.9.2019.
 * Time: 14:06
 */

namespace Mastering\Faq\Model\ResourceModel\Items;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 * @package Mastering\Faq\Model\ResourceModel\Items
 */
class Collection extends AbstractCollection
{

    /***
     * @var string
     */
    protected $_idFieldName = 'faq_id';
    
    protected function _construct()
    {
        $this->_init('Mastering\Faq\Model\Items', 'Mastering\Faq\Model\ResourceModel\Items');
    }

}