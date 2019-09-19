<?php
/**
 * Created by PhpStorm.
 * User: Anita
 * Date: 19.9.2019.
 * Time: 13:18
 */
namespace Mastering\Faq\Controller\Adminhtml\Categories;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Registry;
use Mastering\Faq\Model\Categories;
use Magento\Backend\Model\View\Result\Page;
use Magento\Backend\Model\View\Result\Redirect;

/**
 * Class Edit
 * @package Mastering\Faq\Controller\Adminhtml\Categories
 */

class Edit extends Action
{
    /**
     * @var Registry|null
     */
    protected $_coreRegistry = null;

    /**
     * @var PageFactory
     */
    protected $_resultPageFactory;

    /**
     * @var Categories
     */
    protected $_model;

    /**
     * Edit constructor.
     * @param Action\Context $context
     * @param PageFactory $resultPageFactory
     * @param Registry $registry
     * @param Categories $model
     */
    public function __construct(
        Action\Context $context,
        PageFactory $resultPageFactory,
        Registry $registry,
        Categories $model
    ) {
        $this->_resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $registry;
        $this->_model = $model;
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
     * @return Page
     */
    protected function _initAction()
    {
        /** @var Page $resultPage */
        $resultPage = $this->_resultPageFactory->create();
        // $resultPage->setActiveMenu('MENU ID HERE')
        //    ->addBreadcrumb(__(''), __(''))
        //    ->addBreadcrumb(__('MANAGE '), __('MANAGE '));
        return $resultPage;
    }

    /**
     * @return Page|\Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $model = $this->_model;

        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This  not exists.'));
                /** Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();

                return $resultRedirect->setPath('*/*/');
            }
        }

        $data = $this->_getSession()->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }

        $this->_coreRegistry->register('current_model', $model);

        /** @var Page $resultPage */
        $resultPage = $this->_initAction();
        $resultPage->addBreadcrumb(
            $id ? __('Edit ') : __('New '),
            $id ? __('Edit ') : __('New ')
        );
        $resultPage->getConfig()->getTitle()->prepend(__(''));
        $resultPage->getConfig()->getTitle()
            ->prepend($model->getId() ? __('Edit  ID: ') . $model->getId() : __('New '));

        return $resultPage;
    }
}