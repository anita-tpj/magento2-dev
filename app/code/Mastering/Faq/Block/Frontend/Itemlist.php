<?php

/**
 * Created by PhpStorm.
 * User: Anita
 * Date: 15.9.2019.
 * Time: 00:18
 */

declare(strict_types=1);

namespace Mastering\Faq\Block\Frontend;

use Magento\Framework\View\Element\Template;
use Mastering\Faq\Model\ResourceModel\Items\Collection as Items;
use Mastering\Faq\Model\ResourceModel\Items\CollectionFactory;
use Mastering\Faq\Model\ResourceModel\Categories\Collection as Categories;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Class Itemlist
 * @package Mastering\Faq\Block\Frontend
 */
class Itemlist extends Template
{
    /**
     * Enabled value for FAQ items and categories
     */
    const IS_ENABLED = 1;
    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * @var Items
     */
    protected $items;

    /**
     * @var Ctegories
     */
    protected $categories;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * Itemlist constructor.
     * @param Template\Context $context
     * @param CollectionFactory $collectionFactory
     * @param Items $items
     * @param Categories $categories
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        Template\Context $context,
        CollectionFactory $collectionFactory,
        Items $items,
        Categories $categories,
        StoreManagerInterface $storeManager,
        array $data = []
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->items = $items;
        $this->categories = $categories;
        $this->storeManager = $storeManager;
        parent::__construct($context, $data);
    }

    /**
     * @return mixed
     */
    public function getCategories()
    {
        return $this->categories
            ->addFieldToFilter('status', self::IS_ENABLED)
            ->getData();
    }

    /**
     * @return \Mastering\Faq\Model\Items[]
     */
        public function getItemsCollection()
        {
            return $this->collectionFactory->create()->getItems();
        }

    /**
     * @return Items
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */

    public function getItems()
    {
        $storeId = $this->storeManager->getStore()->getId();

        $collection = $this->items;
        $collection->getSelect()->where('FIND_IN_SET(0, store_ids) OR FIND_IN_SET(?, store_ids)', $storeId);
        $collection = $collection->addFieldToFilter('status', self::IS_ENABLED);
        $collection = $collection->getData();


        return $collection;

    }

    /**
     * Prepares array of categories with related items for template
     * @return array
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getItemsByCategory()
    {
        $categoryFaqs = [];
        $i = 0;

        foreach ($this->getCategories() as $category) {
            $categoryFaqs[$category['category_id']]['name'] = $category['name'];
            $categoryFaqs[$category['category_id']]['category_id'] = $category['category_id'];

            foreach ($this->getItems() as $item) {
                $itemCategories = explode(',', $item['category_ids']);
                if (in_array($category['category_id'], $itemCategories)) {
                    $categoryFaqs[$category['category_id']]['items'][$i] = $item;
                    $i++;
                }
            }
        }
        return $categoryFaqs;
    }
}