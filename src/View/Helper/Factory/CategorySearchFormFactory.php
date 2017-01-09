<?php
namespace Pacificnm\Category\View\Helper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Pacificnm\Category\View\Helper\CategorySearchForm;

class CategorySearchFormFactory
{
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Pacificnm\Category\View\Helper\CategorySearchForm
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        
        $service = $realServiceLocator->get('Pacificnm\Category\Service\ServiceInterface');
        
        $typeService = $realServiceLocator->get('Pacificnm\CategoryType\Service\ServiceInterface');
        
        return new CategorySearchForm($service, $typeService);
        
    }
}

