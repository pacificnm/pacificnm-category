<?php

namespace Pacificnm\Category\Form\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Pacificnm\Category\Form\Form;

class FormFactory
{

    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Category\Form\Form
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $typeService = $serviceLocator->get('Pacificnm\CategoryType\Service\ServiceInterface');
        
        return new Form($typeService);
    }


}

