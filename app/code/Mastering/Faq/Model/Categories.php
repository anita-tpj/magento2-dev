<?php
/**
 * Created by PhpStorm.
 * User: Anita
 * Date: 18.9.2019.
 * Time: 22:49
 */

namespace Mastering\Faq\Model;

use Magento\Framework\Model\AbstractModel;
use Mastering\Faq\Api\Data\CategoriesInterface;
use Magento\Framework\DataObject\IdentityInterface;

/**
 * Class Categories
 * @package Mastering\Faq\Model
 */
class Categories extends AbstractModel implements CategoriesInterface, IdentityInterface
{
    const CACHE_TAG = 'mastering_faq_categories';
    protected $_cacheTag = 'mastering_faq_categories';
    protected $_eventPrefix = 'mastering_faq_categories';

    protected function _construct()
    {
        $this->_init('Mastering\Faq\Model\ResourceModel\Categories');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}