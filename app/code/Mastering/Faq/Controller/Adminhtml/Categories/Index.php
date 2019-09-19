<?php
/**
 * Created by PhpStorm.
 * User: Anita
 * Date: 18.9.2019.
 * Time: 23:14
 */
namespace Mastering\Faq\Controller\Adminhtml\Categories;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\Model\View\Result\Page;

/**
 * Class Index
 * @package Mastering\Faq\Controller\Adminhtml\Categories
 */
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
        /** @var Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        // $resultPage->setActiveMenu('');
        // $resultPage->addBreadcrumb(__(''), __(''));
        // $resultPage->addBreadcrumb(__(''), __(''));
        // $resultPage->getConfig()->getTitle()->prepend(__(''));

        return $resultPage;
    }

}