<?php

namespace Mastering\SampleModule\Cron;

use Mastering\SampleModule\Model\ItemFactory;
use Mastering\SampleModule\Model\Config;

class AddItem
{
    private $itemFactory;

    private $config;

    public function __construct(ItemFactory $itemFactory, Config $config)
    {
        $this->itemFactory = $itemFactory;
        $this->Config = $config;
    }

    public function execute()
    {
        if($this->Config->isEnabled()) {
            $this->itemFactory->create()
                ->setName('Scheduled item')
                ->setDescription('Created at ' . time())
                ->save();
        }
    }
}