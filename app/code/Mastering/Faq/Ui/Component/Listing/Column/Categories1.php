<?php
/**
 * Created by PhpStorm.
 * User: Anita
 * Date: 17.9.2019.
 * Time: 18:03
 */
namespace Mastering\Faq\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\Phrase;
use Mastering\Faq\Model\ResourceModel\Categories as CategoriesCollection;

/**
 * Class Store
 * @package Mastering\Faq\Ui\Component\Listing\Column
 */
class Store extends Column
{
    /**
     * @var CategoriesCollection
     */
    protected $categoriesCollection;

    /**
     * @var string
     */
    protected $categoryKey;

    /**
     * Store constructor.
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param CategoriesCollection $categoriesCollection
     * @param string $categoryKey
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        CategoriesCollection $categoriesCollection,
        $categoryKey = 'category_ids',
        array $components = [],
        array $data = []
    ) {

        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->categoriesCollection = $categoriesCollection;
        $this->categoryKey = $categoryKey;

    }

    /**
     * Prepare Data Source
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $item[$this->getData('name')] = explode(',', $item[$this->getData('name')]);
                $item[$this->getData('name')] = $this->prepareItem($item);
            }
        }

        return $dataSource;
    }

    /**
     * Get data
     * @param array $item
     * @return Phrase|string
     */
    protected function prepareItem(array $item)
    {
        $content = '';
        $columnCategories = $item[$this->categoryKey];
        $data = $this->categories;

        foreach ($data as $website) {
            $content .= "<b>" . $website['label'] . "</b><br/>";
        }

        return $content;
    }
}