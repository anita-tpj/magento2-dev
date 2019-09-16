<?php
/**
 * Created by PhpStorm.
 * User: Anita
 * Date: 16.9.2019.
 * Time: 14:06
 */

namespace Mastering\Faq\Model;

use Magento\Framework\Model\AbstractModel;

/**
 * @method \Mastering\Faq\Model\ResourceModel\Items getResource()
 * @method \Mastering\Faq\Model\ResourceModel\Items\Collection getCollection()
 */
class Items extends AbstractModel implements \Mastering\Faq\Api\Data\ItemsInterface,
    \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'mastering_faq_items';
    protected $_cacheTag = 'mastering_faq_items';
    protected $_eventPrefix = 'mastering_faq_items';

    protected function _construct()
    {
        $this->_init('Mastering\Faq\Model\ResourceModel\Items');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}