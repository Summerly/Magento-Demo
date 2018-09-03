<?php

namespace Learning\HelloPage\Controller\Page;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Psr\Log\LoggerInterface;


class Demo extends Action
{
    protected $resultJsonFactory;
    protected $logger;

    public function __construct(Context $context, JsonFactory $resultJsonFactory, LoggerInterface $logger)
    {
        $this->resultJsonFactory = $resultJsonFactory;
        $this->logger = $logger;
        parent::__construct($context);
    }

    public function execute()
    {
        $data = ['page' => 'From Demo Page'];

        $result = $this->resultJsonFactory->create();

        $this->logger->debug('from demo');

        return $result->setData($data);
    }
}