<?php
namespace Pacificnm\Category\Mapper;

use Zend\Hydrator\HydratorInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Sql\Update;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Delete;
use Pacificnm\Mapper\AbstractMysqlMapper;
use Pacificnm\Category\Entity\Entity;

class MysqlMapper extends AbstractMysqlMapper implements MysqlMapperInterface
{

    /**
     * Mysql Mapper Construct
     *
     * @param AdapterInterface $readAdapter            
     * @param AdapterInterface $writeAdapter            
     * @param HydratorInterface $hydrator            
     * @param Entity $prototype            
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, Entity $prototype)
    {
        $this->hydrator = $hydrator;
        
        $this->prototype = $prototype;
        
        parent::__construct($readAdapter, $writeAdapter);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Pacificnm\Category\Mapper\MysqlMapperInterface::getAll()
     */
    public function getAll(array $filter)
    {
        $this->select = $this->readSql->select('category');
        
        $this->joinParent()->joinType();
        
        $this->filter($filter)->sort($filter);
        
        if (array_key_exists('pagination', $filter)) {
            if ($filter['pagination'] == 'off') {
                return $this->getRows();
            }
        }
        
        return $this->getPaginator();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Pacificnm\Category\Mapper\MysqlMapperInterface::get()
     */
    public function get($id)
    {
        $this->select = $this->readSql->select('category');
        
        $this->joinParent()->joinType();
        
        $this->select->where(array(
            'category.category_id = ?' => $id
        ));
        
        return $this->getRow();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Pacificnm\Category\Mapper\MysqlMapperInterface::getTopCategoryBySlug()
     */
    public function getTopCategoryBySlug($cateogrySlug)
    {
        $this->select = $this->readSql->select('category');
        
        $this->joinParent()->joinType();
        
        $this->select->where(array(
            'category.category_slug = ?' => $cateogrySlug
        ));
        
        $this->select->where(array(
            'category.category_parent_id = ?' => 0
        ));
        
        return $this->getRow();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Pacificnm\Category\Mapper\MysqlMapperInterface::getChildCategoryBySlug()
     */
    public function getChildCategoryBySlug($categoryParentId, $categorySlug)
    {
        $this->select = $this->readSql->select('category');
        
        $this->joinParent()->joinType();
        
        $this->select->where(array(
            'category.category_slug = ?' => $categorySlug
        ));
        
        $this->select->where(array(
            'category.category_parent_id = ?' => $categoryParentId
        ));
        
        return $this->getRow();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Pacificnm\Category\Mapper\MysqlMapperInterface::save()
     */
    public function save(Entity $entity)
    {
        $postData = $this->hydrator->extract($entity);
        
        if ($entity->getCategoryId()) {
            $this->update = new Update('category');
            
            $this->update->set($postData);
            
            $this->update->where(array(
                'category.category_id = ?' => $entity->getCategoryId()
            ));
            
            $this->updateRow();
        } else {
            $this->insert = new Insert('category');
            
            $this->insert->values($postData);
            
            $id = $this->createRow();
            
            $entity->setCategoryId($id);
        }
        
        return $this->get($entity->getCategoryId());
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Pacificnm\Category\Mapper\MysqlMapperInterface::delete()
     */
    public function delete(Entity $entity)
    {
        $this->delete = new Delete('category');
        $this->delete->where(array(
            'category.category_id = ?' => $entity->getCategoryId()
        ));
        
        return $this->deleteRow();
    }

    /**
     * Filters and search
     *
     * @param array $filter            
     * @return \Pacificnm\Category\Mapper\MysqlMapper
     */
    protected function filter(array $filter)
    {
        // categoryParentId
        if (array_key_exists('categoryParentId', $filter) && strlen($filter['categoryParentId']) > 0) {
            $this->select->where(array(
                'category.category_parent_id = ?' => $filter['categoryParentId']
            ));
        }
        
        // categoryLevel
        if (array_key_exists('categoryLevel', $filter) && $filter['categoryLevel'] > 0) {
            $this->select->where(array(
                'category.category_level = ?' => $filter['categoryLevel']
            ));
        }
        
        // categoryActive
        if (array_key_exists('categoryActive', $filter) && strlen($filter['categoryActive']) > 0) {
            $this->select->where(array(
                'category.category_active = ?' => $filter['categoryActive']
            ));
        }
        
        // categoryTypeId
        if(array_key_exists('categoryTypeId', $filter) && strlen($filter['categoryTypeId'])) {
            $this->select->where(array(
                'category.category_type_id = ?' => $filter['categoryTypeId']
            ));
        }
        
        return $this;
    }

    /**
     *
     * @param unknown $filter            
     * @return \Pacificnm\Category\Mapper\MysqlMapper
     */
    protected function sort($filter)
    {
        return $this;
    }

    /**
     *
     * @return \Pacificnm\Category\Mapper\MysqlMapper
     */
    protected function joinParent()
    {
        $this->select->join(array(
            'category_parent' => 'category'
        ), 'category.category_parent_id = category_parent.category_id', array(
            'category_parent_name' => 'category_name',
            'category_parent_slug' => 'category_slug',
            'category_parent_root_id' => 'category_root_id',
            'category_parent_level' => 'category_level',
            'category_parent_active' => 'category_active'
        ), 'left');
        
        return $this;
    }

    /**
     *
     * @return \Pacificnm\Category\Mapper\MysqlMapper
     */
    protected function joinType()
    {
        $this->select->join('category_type', 'category.category_type_id = category_type.category_type_id', array(
            'category_type_name',
            'category_type_active'
        ), 'inner');
        
        return $this;
    }
}

