<?php
/**
 * Created by PhpStorm.
 * User: Anita
 * Date: 17.9.2019.
 * Time: 18:57
 */
namespace Mastering\Faq\Controller\Adminhtml\Items;

use Magento\Backend\App\Action;
use Mastering\Faq\Model\Items;
use Magento\Backend\Model\View\Result\Redirect;

/**
 * Class Delete
 * @package Mastering\Faq\Controller\Adminhtml\Items
 */
class Delete extends Action
{
    /**
     * @var Items
     */
    protected $_model;

    /**
     * Delete constructor.
     * @param Action\Context $context
     * @param Items $model
     */
    public function __construct(
        Action\Context $context,
        \Mastering\Faq\Model\Items $model
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
     * @return Redirect|\Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
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