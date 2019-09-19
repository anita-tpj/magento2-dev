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
use Magento\Store\Model\StoreRepository;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\Exception\LocalizedException;

class Save extends Action
{
    /**
     * @var Items
     */
    protected $_model;

    /**
     * @var StoreRepository
     */
    protected $_storeManager;

    /**
     * Save constructor.
     * @param Action\Context $context
     * @param Items $model
     * @param StoreRepository $storeManager
     */
    public function __construct(
        Action\Context $context,
        Items $model,
        StoreRepository $storeManager
    ) {
        parent::__construct($context);
        $this->_model = $model;
        $this->_storeManager = $storeManager;
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
        $data = $this->getRequest()->getPostValue();
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            /** @var Items $model */
            $model = $this->_model;

            $id = $this->getRequest()->getParam('id');
            if ($id) {
                $model->load($id);
            }

            if (isset($data['category_ids']) && $data['category_ids'] != '') {
                $data['category_ids'] = implode(',', $data['category_ids']);
            }

            if (isset($data['store_ids']) && $data['store_ids'] != '') {
                $stores = [];
                if ($data['store_ids'] == 0) {
                    foreach ($this->_storeManager->getList() as $store) {
                        if ($store->getId() == 0) {
                            continue;
                        }
                        $stores[] = $store->getId();
                    }
                    $data['store_ids'] = implode(',', $stores);
                }
            }

            $model->setData($data);

            try {
                $model->save();
                $this->messageManager->addSuccess(__(' saved'));
                $this->_getSession()->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the '));
            }

            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}