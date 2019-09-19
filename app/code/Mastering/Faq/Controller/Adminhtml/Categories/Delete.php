<?php
/**
 * Created by PhpStorm.
 * User: Anita
 * Date: 19.9.2019.
 * Time: 13:18
 */
namespace Mastering\Faq\Controller\Adminhtml\Categories;

use Magento\Backend\App\Action;
use Mastering\Faq\Model\Categories;
use Magento\Framework\Controller\ResultInterface;
use Magento\Backend\Model\View\Result\Redirect;

/**
 * Class Delete
 * @package Mastering\Faq\Controller\Adminhtml\Categories
 */
class Delete extends Action
{
    protected $_model;

    /**
     * Delete constructor.
     * @param Action\Context $context
     * @param Categories $model
     */
    public function __construct(
        Action\Context $context,
        Categories $model
    ) {
        parent::__construct($context);
        $this->_model = $model;
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Magento_Backend::content');
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Redirect|\Magento\Framework\App\ResponseInterface|ResultInterface
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                $model = $this->_model;
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccess(__(' deleted'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }
        $this->messageManager->addError(__(' does not exist'));
        return $resultRedirect->setPath('*/*/');
    }
}