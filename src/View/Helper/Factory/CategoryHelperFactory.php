<?php
namespace Pacificnm\Category\View\Helper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Pacificnm\Category\View\Helper\CategoryHelper;

class CategoryHelperFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Pacificnm\Category\View\Helper\CategoryHelper
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $service = $realServiceLocator->get('Pacificnm\Category\Service\ServiceInterface');
        
        $memcached = $realServiceLocator->get('memcached');
        
        return new CategoryHelper($service, $memcached);
    }
}

