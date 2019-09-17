<?php

/**
 * Created by PhpStorm.
 * User: Anita
 * Date: 15.9.2019.
 * Time: 00:18
 */

namespace Mastering\Faq\Block\Adminhtml;

use Magento\Backend\Block\Template;
use Mastering\Faq\Model\ResourceModel\Items\Collection;
use Mastering\Faq\Model\ResourceModel\Items\CollectionFactory;

/**
 * Class Itemlist
 * @package Mastering\Faq\Block\Adminhtml
 */
class Itemlist extends Template
{
    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * Faqlist constructor.
     * @param Template\Context $context
     * @param CollectionFactory $collectionFactory
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        CollectionFactory $collectionFactory,
        array $data = []
    ) {
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context, $data);
    }

    /**
     * @return \Mastering\Faq\Model\Items[]
     */
    public function getItems()
    {
        return $this->collectionFactory->create()->getItems();
    }
}