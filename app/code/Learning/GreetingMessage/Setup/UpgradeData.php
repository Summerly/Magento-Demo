<?php

namespace Learning\GreetingMessage\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;

class UpgradeData implements UpgradeDataInterface
{

    /**
     * {@inheritdoc}
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        if ($context->getVersion() && version_compare($context->getVersion(), '0.0.2') < 0) {
            $table = $setup->getTable('greeting_message');
            $setup->getConnection()
                ->insertForce($table, ['message' => 'Happy Thanksgiving', 'season' => 'fall']);
            $setup->getConnection()
                ->update($table, ['season' => 'winter'], 'greeting_id IN (1,2)');
        }
        $setup->endSetup();
    }
}