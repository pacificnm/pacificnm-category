<?php

namespace Pacificnm\Category\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Pacificnm\Category\Controller\CreateController;

class CreateControllerFactory
{

    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Pacificnm\Category\Controller\CreateController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();

        $service = $realServiceLocator->get('Pacificnm\Category\Service\ServiceInterface');

        $form = $realServiceLocator->get('Pacificnm\Category\Form\Form');

        return new CreateController($service, $form);
    }


}

