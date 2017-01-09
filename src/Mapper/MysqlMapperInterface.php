<?php
namespace Pacificnm\Category\Mapper;

use Zend\Paginator\Paginator;
use Pacificnm\Category\Entity\Entity;

interface MysqlMapperInterface
{

    /**
     *
     * @param array $filter            
     * @return Paginator
     */
    public function getAll(array $filter);

    /**
     *
     * @param number $id            
     * @return Entity
     */
    public function get($id);

    /**
     *
     * @param string $cateogrySlug            
     * @return Entity
     */
    public function getTopCategoryBySlug($cateogrySlug);

    /**
     *
     * @param number $categoryParentId            
     * @param string $categorySlug            
     * @return \Pacificnm\Mapper\ArrayObject|\Pacificnm\Mapper\NULL
     */
    public function getChildCategoryBySlug($categoryParentId, $categorySlug);

    /**
     *
     * @param Entity $entity            
     * @return Entity
     */
    public function save(Entity $entity);

    /**
     *
     * @param Entity $entity            
     * @return Boolean
     */
    public function delete(Entity $entity);
}

