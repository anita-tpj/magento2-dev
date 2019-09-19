<?php
/**
 * Created by PhpStorm.
 * User: Anita
 * Date: 17.9.2019.
 * Time: 18:03
 */

namespace Mastering\Faq\Ui\Component\Listing\Column;

use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Mastering\Faq\Model\ResourceModel\Categories\Collection as Categories;

/**
 * Class ItemsCategories
 * @package Mastering\Faq\Ui\Component\Listing\Column
 */
class ItemsCategories extends Column
{
    /** @var Categories */
    protected $categories;

    /**
     * Category constructor.
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param Categories $categories
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        Categories $categories,
        array $components = [],
        array $data = []
    )
    {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->categories = $categories;
    }

    /**
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource): array
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $item[$this->getData('name')] = explode(',', $item[$this->getData('name')]);
                $item[$this->getData('name')] = $this->prepareItem($item);
            }
        }

        return $dataSource;
    }

    /**
     * @param array $item
     * @return string
     */
    protected function prepareItem(array $item)
    {
        $content = '';
        $categories = $this->categories->getData();

        foreach ($item['category_ids'] as $rowCategory) {
            foreach ($categories as $category) {
                if ((int)$category['category_id'] == (int)$rowCategory) {
                    $content .= $category['name'] . "<br/>";
                }
            }
        }

        return $content;
    }
}
