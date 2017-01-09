<?php
namespace Pacificnm\Category\Service;

use Pacificnm\Category\Entity\Entity;
use Pacificnm\Category\Mapper\MysqlMapperInterface;

class Service implements ServiceInterface
{

    protected $mapper = null;

    /**
     * Service Construct
     *
     * @param MysqlMapperInterface $mapper            
     */
    public function __construct(MysqlMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Pacificnm\Category\Service\ServiceInterface::getAll()
     */
    public function getAll(array $filter)
    {
        return $this->mapper->getAll($filter);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Pacificnm\Category\Service\ServiceInterface::get()
     */
    public function get($id)
    {
        return $this->mapper->get($id);
    }

    /**
     * 
     * {@inheritDoc}
     * @see \Pacificnm\Category\Service\ServiceInterface::getTopCategoryBySlug()
     */
    public function getTopCategoryBySlug($cateogrySlug)
    {
        return $this->mapper->getTopCategoryBySlug($cateogrySlug);
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Pacificnm\Category\Service\ServiceInterface::getChildCategoryBySlug()
     */
    public function getChildCategoryBySlug($categoryParentId, $categorySlug)
    {
        return $this->mapper->getChildCategoryBySlug($categoryParentId, $categorySlug);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Pacificnm\Category\Service\ServiceInterface::save()
     */
    public function save(Entity $entity)
    {
        return $this->mapper->save($entity);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Pacificnm\Category\Service\ServiceInterface::delete()
     */
    public function delete(Entity $entity)
    {
        return $this->mapper->delete($entity);
    }
}

