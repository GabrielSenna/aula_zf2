<?php

namespace LivrariaAdmin\Controller;

use Zend\Mvc\Controller\AbstractActionController,
 Zend\View\Model\ViewModel;

use Zend\Paginator\Paginator,
    Zend\Paginator\Adapter\ArrayAdapter;

use LivrariaAdmin\Form\Categoria as FrmCategoria;

class CategoriasController extends AbstractActionController{
    
    /**
     *
     * @var EntityManager
     */
    protected $em;
    
    public function indexAction() {
        $list = $this->getEm()
                ->getRepository(\Livraria\Entity\Categoria::class)
                ->findAll();
        $page = $this->params()->fromRoute('page');
        $paginator = new Paginator(new ArrayAdapter($list));
        $paginator->setCurrentPageNumber($page);
        $paginator->setDefaultItemCountPerPage(1);
        return new ViewModel(['data'=>$paginator, 'page'=>$page]);
    }
    
    public function newAction(){
        $form = new FrmCategoria();
        
        $request = $this->getRequest();
        
        if($request->isPost()){
            $form->setData($request->getPost());
            if($form->isValid()){
                //Método de inserção
                
                return $this->redirect()->toRoute('livraria-admin',['controller'=>'categorias']);
            }
        }
        
        return new ViewModel(['form'=>$form]);
    }


    /*
     * @return EntityManager
     */
    protected function getEm(){
        if(null == $this->em){
            $this->em = $this->getServiceLocator()->get(\Doctrine\ORM\EntityManager::class);
        }
        return $this->em;
    }
}
