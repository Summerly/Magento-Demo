<?php

namespace Learning\ClothingMaterial\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Setup\EavSetupFactory;

class InstallData implements InstallDataInterface
{
    private $eavSetupFactory;

    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $eavSetup = $this->eavSetupFactory->create();
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'clothing_material',
            [
                'group'                    => 'General',
                'type'                     => 'varchar',
                'label'                    => 'Clothing Material',
                'input'                    => 'select',
                'source'                   => 'Learning\ClothingMaterial\Model\Attribute\Source\Material',
                'frontend'                 => 'Learning\ClothingMaterial\Model\Attribute\Frontend\Material',
                'backend'                  => 'Learning\ClothingMaterial\Model\Attribute\Backend\Material',
                'required'                 => false,
                'sort_order'               => 50,
                'global'                   => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                'is_used_in_grid'          => false,
                'is_visible_in_grid'       => false,
                'is_filterable_in_grid'    => false,
                'visible'                  => true,
                'is_html_allowed_on_front' => true,
                'visible_on_front'         => true

            ]
        );
    }
}