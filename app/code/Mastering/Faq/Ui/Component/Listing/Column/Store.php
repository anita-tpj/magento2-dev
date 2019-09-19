<?php
/**
 * Created by PhpStorm.
 * User: Anita
 * Date: 17.9.2019.
 * Time: 18:03
 */
namespace Mastering\Faq\Ui\Component\Listing\Column;

use Magento\Framework\App\ObjectManager;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\Escaper;
use Magento\Framework\Phrase;
use Magento\Store\Model\StoreManagerInterface as StoreManager;
use Magento\Store\Model\System\Store as SystemStore;

/**
 * Class Store
 * @package Mastering\Faq\Ui\Component\Listing\Column
 */
class Store extends Column
{
    /**
     * @var SystemStore
     */
    protected $systemStore;

    /**
     * @var StoreManager
     */
    protected $storeManager;

    /**
     * @var Escaper
     */
    protected $escaper;

    /**
     * @var string
     */
    protected $storeKey;

    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        SystemStore $systemStore,
        StoreManager $storeManager,
        Escaper $escaper,
        $storeKey = 'store_ids',
        array $components = [],
        array $data = []
    ) {

        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->systemStore = $systemStore;
        $this->storeManager = $storeManager;
        $this->escaper = $escaper;
        $this->storeKey = $storeKey;

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
        $origStores = $item[$this->storeKey];
        if (!is_array($origStores)) {
            $origStores = [$origStores];
        }
        if (in_array(0, $origStores)) {
            return __('All Store Views');
        }
        $data = $this->systemStore->getStoresStructure(false, $origStores);

        foreach ($data as $website) {
            $content .= "<b>" . $website['label'] . "</b><br/>";
        }

        return $content;
    }

    /**
     * Prepare component configuration
     * @return void
     */
    public function prepare()
    {
        parent::prepare();
        if ($this->getStoreManager()->isSingleStoreMode()) {
            $this->_data['config']['componentDisabled'] = true;
        }
    }

    /**
     * Get StoreManager dependency
     * @return StoreManager
     * @deprecated
     */
    private function getStoreManager()
    {
        if ($this->storeManager === null) {
            $this->storeManager = ObjectManager::getInstance()
                ->get('Magento\Store\Model\StoreManagerInterface');
        }

        return $this->storeManager;
    }
}