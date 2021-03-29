<?php

namespace Mageplaza\HelloWorld\Setup;

class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
{

	public function install(\Magento\Framework\Setup\SchemaSetupInterface $setup, \Magento\Framework\Setup\ModuleContextInterface $context)
	{
		$installer = $setup;
		$installer->startSetup();
		if (!$installer->tableExists('mageplaza_helloworld_post')) {
			$table = $installer->getConnection()->newTable(
				$installer->getTable('mageplaza_helloworld_post')
			)
				->addColumn(
					'post_id',
					\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
					null,
					[
						'identity' => true,
						'nullable' => false,
						'primary'  => true,
						'unsigned' => true,
					],
					'Post ID'
				)
				->addColumn(
					'first_name',
					\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					255,
					['nullable => false'],
					'first name'
				)
				->addColumn(
					'last_name',
					\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					255,
					[],
					'last name'
				)
				->addColumn(
					'email',
					\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					'64k',
					[],
					'email'
				)
				->addColumn(
					'phone_number',
					\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					255,
					[],
					'phone_number'
				)
				->addColumn(
					'message',
					\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					225,
					[],
					'message'
				)
				->addColumn(
					'created_at',
					\Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
					null,
					['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
					'Created At'
				)->addColumn(
					'updated_at',
					\Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
					null,
					['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
					'Updated At');
			$installer->getConnection()->createTable($table);

			$installer->getConnection()->addIndex(
				$installer->getTable('mageplaza_helloworld_post'),
				$setup->getIdxName(
					$installer->getTable('mageplaza_helloworld_post'),
					['first_name', 'last_name', 'email', 'phone_number', 'message'],
					\Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
				),
				['first_name', 'last_name', 'email', 'phone_number', 'message'],
				\Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
			);
		}
		$installer->endSetup();
	}
}