<?php

namespace Learning\ClothingMaterial\Model\Attribute\Backend;

use Magento\Eav\Model\Entity\Attribute\Backend\AbstractBackend;

class Material extends AbstractBackend
{
    public function validate($object)
    {
        $value = $object->getData($this->getAttribute()->getAttributeCode());
        if (($object->getAttributeSetId() == 10) && ($value == 'wool')) {
            throw new \Magento\Framework\Exception\LocalizedException(
              __('Bottom can not be wool.')
            );
        }

        return true;
    }
}