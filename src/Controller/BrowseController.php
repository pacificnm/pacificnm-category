<?php
namespace Pacificnm\Category\Controller;

use Pacificnm\Controller\AbstractApplicationController;
use Pacificnm\Category\Service\ServiceInterface;
use Zend\View\Model\ViewModel;

class BrowseController extends AbstractApplicationController
{

    /**
     *
     * @var ServiceInterface
     */
    protected $service;

    /**
     *
     * @param ServiceInterface $service            
     */
    public function __construct(ServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Pacificnm\Controller\AbstractApplicationController::indexAction()
     */
    public function indexAction()
    {
        parent::indexAction();
        
        $categorySlug1 = $this->params()->fromRoute('categorySlug1', null);
        
        $categorySlug2 = $this->params()->fromRoute('categorySlug2', null);
        
        $categorySlug3 = $this->params()->fromRoute('categorySlug3', null);
        
        $categorySlug4 = $this->params()->fromRoute('categorySlug4', null);
        
        $title = '';
        
        // get level 1
        if ($categorySlug1) {
            $category1Entity = $this->service->getTopCategoryBySlug($categorySlug1);
            $title .= $category1Entity->getCategoryName();
        }
        
        // get level 2
        if ($categorySlug2 && $category1Entity) {
            $category2Entity = $this->service->getChildCategoryBySlug($category1Entity->getCategoryId(), $categorySlug2);
            $title .= ' - ' . $category2Entity->getCategoryName();
        }
        
        // level 3
        if ($categorySlug3 && $category2Entity) {
            $category3Entity = $this->service->getChildCategoryBySlug($category2Entity->getCategoryId(), $categorySlug3);
            $title .= ' - ' . $category3Entity->getCategoryName();
        }
        
        // level 4
        if ($categorySlug4 && $category3Entity) {
            $category4Entity = $this->service->getChildCategoryBySlug($category3Entity->getCategoryId(), $categorySlug4);
            $title .= ' - ' . $category4Entity->getCategoryName();
        }
        
        $this->layout()->setVariable('categorySlug1', $categorySlug1);
        
        $this->layout()->setVariable('categorySlug2', $categorySlug2);
        
        $this->layout()->setVariable('categorySlug3', $categorySlug3);
        
        $this->layout()->setVariable('categorySlug4', $categorySlug4);
        
        
        // set breadcrumbs
        
        $this->layout()->setVariable('pageSubTitle', $title);
        
        // $layout->setVariable('pageTitle', $entity->getPageTitle());
        
        return new ViewModel(array());
    }

    

    
}

