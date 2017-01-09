<?php

namespace Pacificnm\Category\Hydrator;

use Zend\Hydrator\ClassMethods;
use Pacificnm\Category\Entity\Entity;
use Pacificnm\Category\Entity\ParentEntity;

class Hydrator extends ClassMethods
{

    /**
     * @param string $underscoreSeparatedKeys
     */
    public function __construct($underscoreSeparatedKeys = true)
    {
        parent::__construct($underscoreSeparatedKeys);
    }

    /**
     * {@inheritdoc}
     *
     * @see \Zend\Stdlib\Hydrator\ClassMethods::hydrate()
     */
    public function hydrate(array $data, $object)
    {
        if (! $object instanceof Entity) {
            return $object;
        }
                
        parent::hydrate($data, $object);
          
        $categoryParentEntity = parent::hydrate($data, new ParentEntity());
        
        $object->setCategoryParentEntity($categoryParentEntity);
        
        $categoryTypeEntity = parent::hydrate($data, new \Pacificnm\CategoryType\Entity\Entity());
        
        $object->setCategoryTypeEntity($categoryTypeEntity);
        
        return $object;
    }

    /**
     * {@inheritdoc}
     *
     * @see \Zend\Stdlib\Hydrator\ClassMethods::extract()
     */
    public function extract($object)
    {
        if (! $object instanceof Entity) {
            return $object;
        }
                    
        $data = parent::extract($object);
                 
        unset($data['category_parent_entity']);
                 
        unset($data['category_type_entity']);
        
        return $data;
    }


}

