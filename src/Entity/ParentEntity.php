<?php
namespace Pacificnm\Category\Entity;

class ParentEntity
{

    /**
     *
     * @var number
     */
    protected $categoryParentId;

    /**
     *
     * @var string
     */
    protected $categoryParentName;

    /**
     *
     * @var string
     */
    protected $categoryParentSlug;

    /**
     *
     * @var number
     */
    protected $categoryParentRootId;

    /**
     *
     * @var number
     */
    protected $categoryParentLevel;

    /**
     *
     * @var boolean
     */
    protected $categoryParentActive;

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
     * @return the $categoryParentName
     */
    public function getCategoryParentName()
    {
        return $this->categoryParentName;
    }

    /**
     *
     * @return the $categoryParentSlug
     */
    public function getCategoryParentSlug()
    {
        return $this->categoryParentSlug;
    }

    /**
     *
     * @return the $categoryParentRootId
     */
    public function getCategoryParentRootId()
    {
        return $this->categoryParentRootId;
    }

    /**
     *
     * @return the $categoryParentLevel
     */
    public function getCategoryParentLevel()
    {
        return $this->categoryParentLevel;
    }

    /**
     *
     * @return the $categoryParentActive
     */
    public function getCategoryParentActive()
    {
        return $this->categoryParentActive;
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
     * @param string $categoryParentName            
     */
    public function setCategoryParentName($categoryParentName)
    {
        $this->categoryParentName = $categoryParentName;
    }

    /**
     *
     * @param string $categoryParentSlug            
     */
    public function setCategoryParentSlug($categoryParentSlug)
    {
        $this->categoryParentSlug = $categoryParentSlug;
    }

    /**
     *
     * @param number $categoryParentRootId            
     */
    public function setCategoryParentRootId($categoryParentRootId)
    {
        $this->categoryParentRootId = $categoryParentRootId;
    }

    /**
     *
     * @param number $categoryParentLevel            
     */
    public function setCategoryParentLevel($categoryParentLevel)
    {
        $this->categoryParentLevel = $categoryParentLevel;
    }

    /**
     *
     * @param boolean $categoryParentActive            
     */
    public function setCategoryParentActive($categoryParentActive)
    {
        $this->categoryParentActive = $categoryParentActive;
    }
}

