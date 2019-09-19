<?php
/**
 * Created by PhpStorm.
 * User: Anita
 * Date: 17.9.2019.
 * Time: 18:57
 */
namespace Mastering\Faq\Block\Adminhtml\Items\Edit;

use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Registry;
use Magento\Framework\Data\FormFactory;
use Magento\Store\Model\System\Store;
use Magento\Config\Model\Config\Source\Enabledisable;
use Mastering\Faq\Model\Items;
use Mastering\Faq\Model\ResourceModel\Categories\Collection as Categories;

/**
 * Class Form
 * @package Mastering\Faq\Block\Adminhtml\Items\Edit
 */
class Form extends Generic
{

    /**
     * @var Store
     */
    protected $_systemStore;

    /**
     * @var Enabledisable
     */
    protected $statusOption;

    /**
     * @var Categories
     */
    protected $categories;

    /**
     * Form constructor.
     * @param Context $context
     * @param Registry $registry
     * @param FormFactory $formFactory
     * @param Store $systemStore
     * @param Enabledisable $statusOption
     * @param Categories $categories
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        FormFactory $formFactory,
        Store $systemStore,
        Enabledisable  $statusOption,
        Categories $categories,
        array $data = []
    ) {
        $this->_systemStore = $systemStore;
        $this->statusOption = $statusOption;
        $this->categories = $categories;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Init form
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('items_form');
        $this->setTitle(__('Faq Information'));
    }

    /**
     * @return Generic
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _prepareForm()
    {
        /** @var Items $model */
        $model = $this->_coreRegistry->registry('current_model');

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create(
            ['data' => ['id' => 'edit_form', 'action' => $this->getData('action'), 'method' => 'post']]
        );

        $form->setHtmlIdPrefix('items_');

        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('General Information'), 'class' => 'fieldset-wide']
        );

        if ($model->getId()) {
            $fieldset->addField(
                'faq_id',
                'hidden',
                ['name' => 'faq_id']);
        }

        $fieldset->addField(
            'question',
            'text',
            [   'name' => 'question',
                'label' => __('Question'),
                'title' => __('Question'),
                'required' => true
            ]
        );

        $fieldset->addField(
            'answer',
            'text',
            [   'name' => 'answer',
                'label' => __('Answer'),
                'title' => __('Answer'),
                'required' => true
            ]
        );

        $fieldset->addField(
            'status',
            'select',
            [   'name' => 'status',
                'label' => __('Status'),
                'title' => __('Status'),
                'values' => array_merge(['' => ''], $this->statusOption->toOptionArray())
            ]
        );

        $fieldset->addField(
            'category_ids',
            'multiselect',
            [   'name' => 'category_ids',
                'label' => __('Category'),
                'title' => __('Category'),
                'required' => true,
                'values'   => $this->categories->getCategoriesForSelect()
            ]
        );

        $fieldset->addField(
            'store_ids',
            'select',
            [   'name' => 'store_ids',
                'label' => __('Store View'),
                'title' => __('Store View'),
                'required' => true,
                'values'   => $this->_systemStore->getStoreValuesForForm(false, true)
            ]
        );


        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}