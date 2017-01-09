<?php

namespace Pacificnm\Category\Controller;

use Zend\View\Model\ViewModel;
use Pacificnm\Controller\AbstractApplicationController;
use Pacificnm\Category\Service\ServiceInterface;
use Pacificnm\Category\Form\Form;
use Pacificnm\Filter\Slugify;

class CreateController extends AbstractApplicationController
{

    protected $service = null;

    protected $form = null;

    /**
     * @param ServiceInterface $service
     * @param Form $form
     */
    public function __construct(ServiceInterface $service, Form $form)
    {
        $this->service = $service;

        $this->form = $form;
    }

    /**
     * {@inheritdoc}
     *
     * @see \Pacificnm\Controller\AbstractApplicationController::indexAction()
     */
    public function indexAction()
    {
        parent::indexAction();

        $request = $this->getRequest();

        $categoryParentId = $this->params()->fromQuery('categoryParentId', 0);
        
        $categoryRootId = $this->params()->fromQuery('categoryRootId', 0);
        
        $categoryLevel = $this->params()->fromQuery('categoryLevel', 0);
        
        $filter = new Slugify();
        
        if ($request->isPost()) {
        	$postData = $request->getPost();

        	$this->form->setData($postData);

        	if ($this->form->isValid()) {
        		$entity = $this->form->getData();

        		$entity->setCategorySlug($filter->filter($entity->getCategoryName()));

        		$entity->setCategoryLevel($entity->getCategoryLevel() + 1);
        		
        		$categoryEntity = $this->service->save($entity);

        		// if category root is 0 we are a parent 
        		if($categoryEntity->getCategoryRootId() == 0 ) {
        		    $categoryEntity->setCategoryRootId($categoryEntity->getCategoryId());
        		    $categoryEntity = $this->service->save($categoryEntity);
        		}
        		
        		
        		$this->getEventManager()->trigger('categoryCreate', $this, array(
        			'authId' => $this->identity()->getAuthId(),
        			'requestUrl' => $this->getRequest()->getUri(),
        			'categoryEntity' => $entity
        		));

        		$this->flashMessenger()->addSuccessMessage('Object was saved');

        		return $this->redirect()->toRoute('category-view', array(
        			'id' => $categoryEntity->getCategoryId()
        		));
        	}
        }

        $this->form->get('categoryParentId')->setValue($categoryParentId);
        
        $this->form->get('categoryRootId')->setValue($categoryRootId);
        
        $this->form->get('categoryLevel')->setValue($categoryLevel);
        
        $this->form->get('categoryId')->setValue(0);
        
        return new ViewModel(array(
        	'form' => $this->form
        ));
    }


}

