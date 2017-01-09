<?php

namespace Pacificnm\Category\Service\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Pacificnm\Category\Service\Service;

class ServiceFactory
{

    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return Pacificnm\Category\Service\Service
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $mapper = $serviceLocator->get('Pacificnm\Category\Mapper\MysqlMapperInterface');

        return new Service($mapper);
    }


}

