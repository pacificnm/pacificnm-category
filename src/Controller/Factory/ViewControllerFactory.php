<?php
namespace Pacificnm\Category\Controller\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Pacificnm\Category\Controller\ViewController;

class ViewControllerFactory
{

    /**
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return \Pacificnm\Category\Controller\ViewController
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $service = $realServiceLocator->get('Pacificnm\Category\Service\ServiceInterface');
        
        $attributeValueService = $realServiceLocator->get('Pacificnm\CategoryAttributeValue\Service\ServiceInterface');
        
        return new ViewController($service, $attributeValueService);
    }
}

