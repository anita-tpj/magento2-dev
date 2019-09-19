<?php
/**
 * Created by PhpStorm.
 * User: Anita
 * Date: 19.9.2019.
 * Time: 13:18
 */
namespace Mastering\Faq\Block\Adminhtml\Categories;

use Magento\Backend\Block\Widget\Form\Container;
use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Registry;
use Magento\Framework\Phrase;

class Edit extends Container
{
    /**
     * @var Registry|null
     */
    protected $_coreRegistry = null;

    /**
     * Edit constructor.
     * @param Context $context
     * @param Registry $registry
     * @param array $data
     */
    public function __construct(
       Context $context,
       Registry $registry,
       array $data = []
    ) {
       $this->_coreRegistry = $registry;
       parent::__construct($context, $data);
    }

    /**
    *
    * @return void
    */
    protected function _construct()
    {
       $this->_objectId = 'id';
       $this->_blockGroup = 'Mastering_Faq';
       $this->_controller = 'adminhtml_categories';

       parent::_construct();

       if ($this->_isAllowedAction('Magento_Backend::content')) {
           $this->buttonList->update('save', 'label', __('Save '));
           $this->buttonList->add(
               'saveandcontinue',
               [
                   'label' => __('Save and Continue Edit'),
                   'class' => 'save',
                   'data_attribute' => [
                       'mage-init' => [
                           'button' => ['event' => 'saveAndContinueEdit', 'target' => '#edit_form'],
                       ],
                   ]
               ],
               -100
           );

       } else {
           $this->buttonList->remove('save');
       }

    }


    /**
     * @return Phrase|string
     */
    public function getHeaderText()
    {
       if ($this->_coreRegistry->registry('current_model')->getId()) {
           return __("Edit  '%1'", $this->escapeHtml($this->_coreRegistry->registry('current_model')->getName()));
       } else {
           return __('New ');
       }
    }

    /**
    * Check permission for passed action
    *
    * @param string $resourceId
    * @return bool
    */
    protected function _isAllowedAction($resourceId)
    {
       return $this->_authorization->isAllowed($resourceId);
    }

    /**
    * Getter of url for "Save and Continue" button
    * tab_id will be replaced by desired by JS later
    *
    * @return string
    */
    protected function _getSaveAndContinueUrl()
    {
       return $this->getUrl('*/*/save', ['_current' => true, 'back' => 'edit', 'active_tab' => '']);
    }
}