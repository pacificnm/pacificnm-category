<?php

namespace Pacificnm\Category\Form;

use Zend\Form\Form as ZendForm;
use Zend\InputFilter\InputFilterProviderInterface;
use Pacificnm\Category\Entity\Entity;
use Pacificnm\Category\Hydrator\Hydrator;
use Pacificnm\CategoryType\Service\ServiceInterface as TypeServiceInterface;

class Form extends ZendForm implements InputFilterProviderInterface
{
    /**
     * 
     * @var TypeServiceInterface
     */
    protected $typeService;
    

    /**
     * 
     * @param TypeServiceInterface $typeService
     * @param string $name
     * @param array $options
     */
    public function __construct(TypeServiceInterface $typeService, $name = 'category-form', $options = array())
    {
        parent::__construct($name, $options);

        $this->setHydrator(new Hydrator(false));

        $this->setObject(new Entity());

        $this->typeService = $typeService;
        
        // categoryId
        $this->add(array(
            'name' => 'categoryId',
            'type' => 'hidden',
            'attributes' => array(
                'id' => 'categoryId'
            )
        ));
        
        // categoryTypeId
        $this->add(array(
            'type' => 'Select',
            'name' => 'categoryTypeId',
            'options' => array(
                'label' => 'Category Type:',
                'value_options' => $this->getTypeOptions()
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'categoryTypeId'
            )
        ));
        
        
        // categoryName
        $this->add(array(
            'name' => 'categoryName',
            'type' => 'Text',
            'options' => array(
                'label' => 'Category Name:'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'categoryName'
            )
        ));
        
        // categorySlug
        $this->add(array(
            'name' => 'categorySlug',
            'type' => 'hidden',
            'attributes' => array(
                'id' => 'categorySlug'
            )
        ));
        
        // categoryParentId
        $this->add(array(
            'name' => 'categoryParentId',
            'type' => 'hidden',
            'attributes' => array(
                'id' => 'categoryParentId'
            )
        ));
        
        // categoryRootId
        $this->add(array(
            'name' => 'categoryRootId',
            'type' => 'hidden',
            'attributes' => array(
                'id' => 'categoryRootId'
            )
        ));
        
        // categoryLevel
        $this->add(array(
            'name' => 'categoryLevel',
            'type' => 'hidden',
            'attributes' => array(
                'id' => 'categoryLevel'
            )
        ));
        
        // categoryActive
        $this->add(array(
            'type' => 'Checkbox',
            'name' => 'categoryActive',
            'options' => array(
                'label' => 'Active',
                'use_hidden_element' => true,
                'checked_value' => '1',
                'unchecked_value' => '0'
            ),
            'attributes' => array(
                'id' => 'categoryActive'
            )
        ));
        
        $this->add(array(
        	'name' => 'submit',
        	'type' => 'button',
        	'attributes' => array(
        		'value' => 'Submit',
        		'id' => 'submit',
        		'class' => 'btn btn-primary btn-flat'
        	)
        ));
    }

    /**
     * {@inheritdoc}
     *
     * @see
     * \Zend\InputFilter\InputFilterProviderInterface::getInputFilterSpecification()
     */
    public function getInputFilterSpecification()
    {
        return array(
            // categoryId
            
            // categoryName
            
            // categorySlug
            
            // categoryParentId
            
            // categoryRootId
            
            // categoryLevel
            
            // categoryActive
        );
    }


    /**
     * 
     * @return NULL[]
     */
    protected function getTypeOptions()
    {
        $options = array();
        
        $entitys = $this->typeService->getAll(array(
            'pagination' => 'off',
            'categoryTypeActive' => 1
        ));
        
        foreach($entitys as $entity) {
            $options[$entity->getCategoryTypeId()] = $entity->getCategoryTypeName();
        }
        
        return $options;
    }
}

