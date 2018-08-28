<?php

namespace Learning\GreetingMessage\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface
{

    /**
     * {@inheritdoc}
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        /**
         * Create table 'greeting_message'
         */
        $table = $setup->getConnection()
            ->newTable($setup->getTable('greeting_message'))
            ->addColumn(
                'greeting_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['auto_increment' => true, 'identify' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Greeting ID'
            )
            ->addColumn(
                'message',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false, 'default' => ''],
                'Message'
            )
            ->setComment('Greeting Message table');
        $setup->getConnection()->createTable($table);
    }
}