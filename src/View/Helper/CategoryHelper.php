<?php
namespace Pacificnm\Category\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Pacificnm\Category\Service\ServiceInterface;
use Zend\Cache\Storage\Adapter\Memcached;

class CategoryHelper extends AbstractHelper
{

    /**
     *
     * @var ServiceInterface
     */
    protected $service;

    /**
     *
     * @var number
     */
    protected $catgoryId;

    /**
     * 
     * @var Memcached
     */
    protected $memcached;
    
    /**
     *
     * @param ServiceInterface $service            
     */
    public function __construct(ServiceInterface $service, Memcached $memcahced)
    {
        $this->service = $service;
        
        $this->memcached = $memcahced;
    }

    /**
     * 
     * @param string $categorySlug1
     * @param string $categorySlug2
     * @param string $categorySlug3
     * @param string $categorySlug4
     */
    public function __invoke($categorySlug1 = null, $categorySlug2 = null, $categorySlug3 = null, $categorySlug4 = null)
    {
        $view = $this->getView();
        
        $partialHelper = $view->plugin('partial');
        
        $data = new \stdClass();
        
        $memcacheKey = 'browse';
        
        // get level 1
        if ($categorySlug1) {
            $category1Entity = $this->service->getTopCategoryBySlug($categorySlug1);
            $data->categorySlug1 = $categorySlug1;
            $memcacheKey .= '-' . $categorySlug1;
        }
        
        // get level 2
        if ($categorySlug2 && $category1Entity) {
            $category2Entity = $this->service->getChildCategoryBySlug($category1Entity->getCategoryId(), $categorySlug2);
            $data->categorySlug2 = $categorySlug2;
            $memcacheKey .= '-' . $categorySlug2;
        }
        
        // level 3
        if ($categorySlug3 && $category2Entity) {
            $category3Entity = $this->service->getChildCategoryBySlug($category2Entity->getCategoryId(), $categorySlug3);
            $data->categorySlug3 = $categorySlug3;
            $memcacheKey .= '-' . $categorySlug3;
        }
        
        // level 4
        if ($categorySlug4 && $category3Entity) {
            $category4Entity = $this->service->getChildCategoryBySlug($category3Entity->getCategoryId(), $categorySlug4);
            $data->categorySlug4 = $categorySlug4;
            $memcacheKey .= '-' . $categorySlug4;
        }
        
        // create tree
        $categoryTree = $this->memcached->getItem($memcacheKey);
        
        if(! $categoryTree) {
        
            $rootCategorys = $this->getCategoryTree(0);
            
            $categoryTree = array();
            
            foreach ($rootCategorys as $rootCategory) {
                
                if ($categorySlug1 && $rootCategory['categoryId'] == $category1Entity->getCategoryId()) {
                    $level1Entitys = $this->getCategoryTree($category1Entity->getCategoryId());
                    
                    foreach ($level1Entitys as $key => $level1Entity) {
                        
                        if ($categorySlug2 && $level1Entity['categoryId'] == $category2Entity->getCategoryId()) {
                            
                            $level2Entitys = $this->getCategoryTree($category2Entity->getCategoryId());
                            
                            foreach ($level2Entitys as $key => $level2Entity) {
                                
                                if ($categorySlug3 && $level2Entity['categoryId'] == $category3Entity->getCategoryId()) {
                                    $level3Entitys = $this->getCategoryTree($category3Entity->getCategoryId());
                                    
                                    foreach ($level3Entitys as $key => $level3Entity) {
                                        $level3Entitys[$key]['categoryUrl'] = '/browse/' . $rootCategory['categorySlug'] . '/' . $level1Entity['categorySlug'] . '/' . $level2Entity['categorySlug'] . '/' . $level3Entity['categorySlug'];
                                    }
                                    
                                    $level2Entitys[$key]['categoryUrl'] = '/browse/' . $rootCategory['categorySlug'] . '/' . $level1Entity['categorySlug'] . '/' . $level2Entity['categorySlug'];
                                    $level2Entitys[$key]['categoryChildren'] = $level3Entitys;
                                } else {
                                    $level2Entitys[$key]['categoryUrl'] = '/browse/' . $rootCategory['categorySlug'] . '/' . $level1Entity['categorySlug'] . '/' . $level2Entity['categorySlug'];
                                    $level2Entitys[$key]['categoryChildren'] = array();
                                }
                            }
                            
                            $level1Entitys[$key]['categoryUrl'] = '/browse/' . $rootCategory['categorySlug'] . '/' . $level1Entity['categorySlug'];
                            $level1Entitys[$key]['categoryChildren'] = $level2Entitys;
                        } else {
                            $level1Entitys[$key]['categoryUrl'] = '/browse/' . $rootCategory['categorySlug'] . '/' . $level1Entity['categorySlug'];
                            $level1Entitys[$key]['categoryChildren'] = array();
                        }
                    }
                    
                    $rootCategory['categoryUrl'] = '/browse/' . $rootCategory['categorySlug'];
                    $rootCategory['categoryChildren'] = $level1Entitys;
                } else {
                    $rootCategory['categoryUrl'] = '/browse/' . $rootCategory['categorySlug'];
                    $rootCategory['categoryChildren'] = array();
                }
                
                $categoryTree[] = $rootCategory;
            }
        
            $this->memcached->setItem($memcacheKey, $categoryTree);
        }
        
        $data->categoryTree = $categoryTree;
        
        return $partialHelper('partials/category-helper.phtml', $data);
    }

    /**
     *
     * @param number $categoryParentId            
     * @return array
     */
    protected function getCategoryTree($categoryParentId = 0)
    {
        $categoryTreeArray = array();
        
        $entitys = $this->service->getAll(array(
            'pagination' => 'off',
            'categoryParentId' => $categoryParentId
        ));
        
        foreach ($entitys as $entity) {
            
            $categoryTreeArray[] = array(
                'categoryId' => $entity->getCategoryId(),
                'categoryParentId' => $entity->getCategoryParentId(),
                'categorySlug' => $entity->getCategorySlug(),
                'categoryName' => $entity->getCategoryName()
            );
        }
        
        return $categoryTreeArray;
    }
}

