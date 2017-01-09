<?php

namespace Pacificnm\Category\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Pacificnm\Category\Controller\RestController;

class RestControllerFactory
{

    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Pacificnm\Category\Controller\RestController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();

        $service = $realServiceLocator->get('Pacificnm\Category\Service\ServiceInterface');

        return new RestController($service);
    }


}

