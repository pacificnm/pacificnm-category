<?php

namespace Pacificnm\Category\Controller;

use Zend\View\Model\ViewModel;
use Pacificnm\Controller\AbstractApplicationController;
use Pacificnm\Category\Service\ServiceInterface;
use Pacificnm\CategoryAttributeValue\Service\ServiceInterface as AttributeValueServiceInterface;

class ViewController extends AbstractApplicationController
{

    /**
     * 
     * @var ServiceInterface
     */
    protected $service = null;

    /**
     * 
     * @var AttributeValueServiceInterface
     */
    protected $attributeValueService;
    
    
    /**
     * 
     * @param ServiceInterface $service
     * @param AttributeValueServiceInterface $attributeValueService
     */
    public function __construct(ServiceInterface $service,  AttributeValueServiceInterface $attributeValueService)
    {
        $this->service = $service;
        
        $this->attributeValueService = $attributeValueService;
    }

    /**
     * {@inheritdoc}
     *
     * @see \Pacificnm\Controller\AbstractApplicationController::indexAction()
     */
    public function indexAction()
    {
        parent::indexAction();

        $id = $this->params()->fromRoute('id');

        $entity = $this->service->get($id);

        if(! $entity) {
        	$this->flashMessenger()->addErrorMessage('Object was not found');
        	return $this->redirect()->toRoute('category-index');
        }

        $filter = array(
            'page' => $this->page,
            'count-per-page' => $this->countPerPage,
            'categoryParentId' => $id
        );
        
        $paginator = $this->service->getAll($filter);
        
        $paginator->setCurrentPageNumber($filter['page']);
        
        $paginator->setItemCountPerPage($filter['count-per-page']);
        
        $attributeValueEntitys = $this->attributeValueService->getAll(array(
            'pagination' => 'off',
            'categoryId' => $id
        ));
        
        
        
        $this->getEventManager()->trigger('categoryView', $this, array(
        	'authId' => $this->identity()->getAuthId(),
        	'requestUrl' => $this->getRequest()->getUri(),
        	'categoryEntity' => $entity
        ));

        return new ViewModel(array(
        	'entity' => $entity,
            'paginator' => $paginator,
            'page' => $filter['page'],
            'count-per-page' => $filter['count-per-page'],
            'itemCount' => $paginator->getTotalItemCount(),
            'pageCount' => $paginator->count(),
            'queryParams' => $this->params()->fromQuery(),
            'routeParams' => $this->params()->fromRoute(),
            'attributeValueEntitys' => $attributeValueEntitys
        ));
    }


}

