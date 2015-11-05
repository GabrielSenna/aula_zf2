<?php

namespace LivrariaAdmin\Controller;

use Zend\Mvc\Controller\AbstractActionController;

use Zend\View\Model\ViewModel;

use LivrariaAdmin\Form\Login as LoginForm;

use Zend\Authentication\Storage\Session as SessionStorage;

use Zend\Authentication\AuthenticationService;

class AuthController extends AbstractActionController{

    public function indexAction() {
        $form = new LoginForm;
        $error = false;
        $request = $this->getRequest();
        if($request->isPost()){
            $form->setData($request->getPost());
            if($form->isValid()){
                $data = $request->getPost()->toArray();
                $auth = new AuthenticationService;
                $sessionStorage = new SessionStorage('LivrariaAdmin');
                $auth->setStorage($sessionStorage);
                
                $authAdapter = $this->getServiceLocator()->get(\Livraria\Auth\Adapter::class);
                
                $authAdapter->setUsername($data['email'])
                        ->setPassword($data['password']);
                $result = $auth->authenticate($authAdapter);
                
                if($result->isValid()){
                    $sessionStorage->write($auth->getIdentity()['user'], null);
                    return $this->redirect()->toRoute('livraria-admin',['controller'=>'categorias']);
                }
                else{
                    $error = true;
                }
            }
        }
        return new ViewModel(['form'=>$form, 'error'=>$error]);
    }
    
    public function logoutAction(){
        $auth = new AuthenticationService();
        $auth->setStorage(new SessionStorage('LivrariaAdmin'));
        $auth->clearIdentity();
        
        return $this->redirect()->toRoute('livraria-admin-auth');
    }
}
