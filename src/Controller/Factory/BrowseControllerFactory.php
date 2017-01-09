<?php
namespace Pacificnm\Category\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Pacificnm\Category\Controller\BrowseController;

class BrowseControllerFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Pacificnm\Category\Controller\BrowseController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $service = $realServiceLocator->get('Pacificnm\Category\Service\ServiceInterface');
        
        return new BrowseController($service);
        
    }
}

