<?php

namespace Pacificnm\Category\Mapper\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Hydrator\Aggregate\AggregateHydrator;
use Pacificnm\Category\Hydrator\Hydrator;
use Pacificnm\Category\Entity\Entity;
use Pacificnm\Category\Mapper\MysqlMapper;

class MysqlMapperFactory
{

    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return \Pacificnm\Category\Mapper\MysqlMapper
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator)
    {
        $hydrator = new AggregateHydrator();
                    
        $hydrator->add(new Hydrator());  
                    
        $prototype = new Entity();
                    
        $writeAdapter = $serviceLocator->get('db1');
                    
        $readAdapter = $serviceLocator->get('db2');
                    
        return new MysqlMapper($readAdapter, $writeAdapter, $hydrator, $prototype);
    }


}

