<?php

/**
 * Created by PhpStorm.
 * User: Anita
 * Date: 16.9.2019.
 * Time: 14:26
 */

namespace Mastering\Faq\Controller\Index;

use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\Action;

/**
 * Class Index
 * @package Mastering\Faq\Controller\Index
 */
class Index extends Action
{
    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }

}