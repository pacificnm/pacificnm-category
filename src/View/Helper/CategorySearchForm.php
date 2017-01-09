<?php
namespace Pacificnm\Category\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Pacificnm\Category\Service\ServiceInterface;
use Pacificnm\CategoryType\Service\ServiceInterface as TypeServiceInterface;

class CategorySearchForm extends AbstractHelper
{

    /**
     *
     * @var ServiceInterface
     */
    protected $service;

    /**
     *
     * @var TypeServiceInterface
     */
    protected $typeService;

    /**
     *
     * @param ServiceInterface $service            
     * @param TypeServiceInterface $typeService            
     */
    public function __construct(ServiceInterface $service, TypeServiceInterface $typeService)
    {
        $this->service = $service;
        
        $this->typeService = $typeService;
    }

    /**
     *
     * @param array $queryParams            
     */
    public function __invoke(array $queryParams = array())
    {
        $view = $this->getView();
        
        $partialHelper = $view->plugin('partial');
        
        $data = new \stdClass();
        
        $data->entitys = $this->getRootCategories();
        
        $data->typeEntitys = $this->getCategoryTypes();
        
        $data->queryParams = $queryParams;
        
        return $partialHelper('partials/category-search-form.phtml', $data);
    }

    /**
     *
     * @return \Pacificnm\Category\Service\Paginator
     */
    protected function getRootCategories()
    {
        $filter = array(
            'pagination' => 'off',
            'categoryParentId' => 0
        );
        
        $entitys = $this->service->getAll($filter);
        
        return $entitys;
    }

    /**
     *
     * @return \Pacificnm\CategoryType\Service\Paginator
     */
    protected function getCategoryTypes()
    {
        $filter = array(
            'pagination' => 'off',
            'categoryTypeActive' => 1
        );
        
        $entitys = $this->typeService->getAll($filter);
        
        return $entitys;
    }
}

