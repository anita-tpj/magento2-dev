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

    /**
     * @return array
     */

    public function getCategoriesForSelect(): array
    {
        $result = [];
        $categories = $this->getData();
        $i = 0;

        foreach ($categories as $category) {
            $result[$i]['value'] = $category['category_id'];
            $result[$i]['label'] = $category['name'];
            $i++;
        }

        return $result;
    }
}