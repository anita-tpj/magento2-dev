<?php
/**
 * Created by PhpStorm.
 * User: Anita
 * Date: 19.9.2019.
 * Time: 13:18
 */
namespace Mastering\Faq\Controller\Adminhtml\Categories;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\ForwardFactory;
use Magento\Backend\Model\View\Result\Forward;

/**
 * Class Create
 * @package Mastering\Faq\Controller\Adminhtml\Categories
 */
class Create extends Action
{
    /**
     * @var ForwardFactory
     */
   protected $_resultForwardFactory;

    /**
     * Create constructor.
     * @param Context $context
     * @param ForwardFactory $resultForwardFactory
     */
   public function __construct(
       Context $context,
       ForwardFactory $resultForwardFactory
   ) {
       $this->_resultForwardFactory = $resultForwardFactory;
       parent::__construct($context);
   }

   /**
    * {@inheritdoc}
    */
   protected function _isAllowed()
   {
       return $this->_authorization->isAllowed('Magento_Backend::content');
   }

    /**
     * @return Forward|\Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
   public function execute()
   {
       /** @var Forward $resultForward */
       $resultForward = $this->_resultForwardFactory->create();
       return $resultForward->forward('edit');
   }
}