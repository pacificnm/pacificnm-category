<?php

namespace Pacificnm\Category\Controller;

use Zend\View\Model\ViewModel;
use Pacificnm\Controller\AbstractApplicationController;
use Pacificnm\Category\Service\ServiceInterface;

class IndexController extends AbstractApplicationController
{

    protected $service = null;

    /**
     * @param ServiceInterface $service
     */
    public function __construct(ServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * {@inheritdoc}
     *
     * @see \Pacificnm\Controller\AbstractApplicationController::indexAction()
     */
    public function indexAction()
    {
        parent::indexAction();

        $this->getEventManager()->trigger('categoryIndex', $this, array(
        	'authId' => $this->identity()->getAuthId(),
        	'requestUrl' => $this->getRequest()->getUri()
        ));

        $filter = array(
        	'page' => $this->page,
        	'count-per-page' => $this->countPerPage,
            'categoryParentId' => $this->params()->fromQuery('categoryParentId', null),
            'categoryLevel' => $this->params()->fromQuery('categoryLevel', null),
            'categoryActive' => $this->params()->fromQuery('categoryActive', null),
            'categoryTypeId' => $this->params()->fromQuery('categoryTypeId', null),
            
        );

        $paginator = $this->service->getAll($filter);

        $paginator->setCurrentPageNumber($filter['page']);

        $paginator->setItemCountPerPage($filter['count-per-page']);

        return new ViewModel(array(
        	'paginator' => $paginator,
        	'page' => $filter['page'],
        	'count-per-page' => $filter['count-per-page'],
        	'itemCount' => $paginator->getTotalItemCount(),
        	'pageCount' => $paginator->count(),
        	'queryParams' => $this->params()->fromQuery(),
        	'routeParams' => $this->params()->fromRoute()
        ));
    }


}

