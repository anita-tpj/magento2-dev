<?php
/**
 * Created by PhpStorm.
 * User: Anita
 * Date: 19.9.2019.
 * Time: 13:18
 */
namespace Mastering\Faq\Block\Adminhtml\Categories\Edit;

use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Registry;
use Magento\Framework\Data\FormFactory;
use Magento\Store\Model\System\Store;
use Mastering\Faq\Model\Categories;
use Magento\Config\Model\Config\Source\Enabledisable;


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
     * Form constructor.
     * @param Context $context
     * @param Registry $registry
     * @param FormFactory $formFactory
     * @param Store $systemStore
     * @param Enabledisable $statusoption
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        FormFactory $formFactory,
        Store $systemStore,
        Enabledisable $statusOption,
        array $data = []
    ) {
        $this->_systemStore = $systemStore;
        $this->statusOption = $statusOption;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Init form
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('categories_form');
        $this->setTitle(__(' Information'));
    }

    /**
     * @return Generic
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _prepareForm()
    {
        /** @var Categories $model */
        $model = $this->_coreRegistry->registry('current_model');

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create(
            ['data' => ['id' => 'edit_form', 'action' => $this->getData('action'), 'method' => 'post']]
        );

        $form->setHtmlIdPrefix('categories_');

        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('General Information'), 'class' => 'fieldset-wide']
        );

        if ($model->getId()) {
            $fieldset->addField('category_id', 'hidden', ['name' => 'category_id']);
        }

        $fieldset->addField(
            'name',
            'text',
            [   'name' => 'name',
                'label' => __('Title'),
                'title' => __('Title'),
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




        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}