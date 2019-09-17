<?php
/**
 * Created by PhpStorm.
 * User: Anita
 * Date: 17.9.2019.
 * Time: 18:03
 */
namespace Mastering\Faq\Controller\Adminhtml\Items;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\Model\View\Result\Page;

class Index extends Action
{

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;


    /**
     * Index constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * @return Page|\Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /**
         * @var Page $resultPage
         */
        $resultPage = $this->resultPageFactory->create();
        // $resultPage->setActiveMenu('');
        // $resultPage->addBreadcrumb(__(''), __(''));
        // $resultPage->addBreadcrumb(__(''), __(''));
        // $resultPage->getConfig()->getTitle()->prepend(__(''));

        return $resultPage;
    }

}