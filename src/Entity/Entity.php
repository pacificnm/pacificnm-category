<?php
namespace Pacificnm\Category\Entity;

use Pacificnm\CategoryType\Entity\Entity as CategoryTypeEntity;

class Entity
{

    /**
     *
     * @var number
     */
    protected $categoryId;

    /**
     *
     * @var number
     */
    protected $categoryTypeId;

    /**
     *
     * @var string
     */
    protected $categoryName;

    /**
     *
     * @var string
     */
    protected $categorySlug;

    /**
     *
     * @var number
     */
    protected $categoryParentId;

    /**
     *
     * @var number
     */
    protected $categoryRootId;

    /**
     *
     * @var number
     */
    protected $categoryLevel;

    /**
     *
     * @var number
     */
    protected $categoryActive;

    /**
     *
     * @var ParentEntity
     */
    protected $categoryParentEntity;

    /**
     *
     * @var CategoryTypeEntity
     */
    protected $categoryTypeEntity;

    /**
     *
     * @return the $categoryId
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     *
     * @return the $categoryTypeId
     */
    public function getCategoryTypeId()
    {
        return $this->categoryTypeId;
    }

    /**
     *
     * @return the $categoryName
     */
    public function getCategoryName()
    {
        return $this->categoryName;
    }

    /**
     *
     * @return the $categorySlug
     */
    public function getCategorySlug()
    {
        return $this->categorySlug;
    }

    /**
     *
     * @return the $categoryParentId
     */
    public function getCategoryParentId()
    {
        return $this->categoryParentId;
    }

    /**
     *
     * @return the $categoryRootId
     */
    public function getCategoryRootId()
    {
        return $this->categoryRootId;
    }

    /**
     *
     * @return the $categoryLevel
     */
    public function getCategoryLevel()
    {
        return $this->categoryLevel;
    }

    /**
     *
     * @return the $categoryActive
     */
    public function getCategoryActive()
    {
        return $this->categoryActive;
    }

    /**
     *
     * @return the $categoryParentEntity
     */
    public function getCategoryParentEntity()
    {
        return $this->categoryParentEntity;
    }

    /**
     *
     * @return the $categoryTypeEntity
     */
    public function getCategoryTypeEntity()
    {
        return $this->categoryTypeEntity;
    }

    /**
     *
     * @param number $categoryId            
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;
    }

    /**
     *
     * @param number $categoryTypeId            
     */
    public function setCategoryTypeId($categoryTypeId)
    {
        $this->categoryTypeId = $categoryTypeId;
    }

    /**
     *
     * @param string $categoryName            
     */
    public function setCategoryName($categoryName)
    {
        $this->categoryName = $categoryName;
    }

    /**
     *
     * @param string $categorySlug            
     */
    public function setCategorySlug($categorySlug)
    {
        $this->categorySlug = $categorySlug;
    }

    /**
     *
     * @param number $categoryParentId            
     */
    public function setCategoryParentId($categoryParentId)
    {
        $this->categoryParentId = $categoryParentId;
    }

    /**
     *
     * @param number $categoryRootId            
     */
    public function setCategoryRootId($categoryRootId)
    {
        $this->categoryRootId = $categoryRootId;
    }

    /**
     *
     * @param number $categoryLevel            
     */
    public function setCategoryLevel($categoryLevel)
    {
        $this->categoryLevel = $categoryLevel;
    }

    /**
     *
     * @param number $categoryActive            
     */
    public function setCategoryActive($categoryActive)
    {
        $this->categoryActive = $categoryActive;
    }

    /**
     *
     * @param \Pacificnm\Category\Entity\ParentEntity $categoryParentEntity            
     */
    public function setCategoryParentEntity($categoryParentEntity)
    {
        $this->categoryParentEntity = $categoryParentEntity;
    }

    /**
     *
     * @param \Pacificnm\CategoryType\Entity\Entity $categoryTypeEntity            
     */
    public function setCategoryTypeEntity($categoryTypeEntity)
    {
        $this->categoryTypeEntity = $categoryTypeEntity;
    }
}

