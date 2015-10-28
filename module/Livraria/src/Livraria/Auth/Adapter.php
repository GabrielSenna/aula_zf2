<?php

namespace Livraria\Auth;

use Zend\Authentication\Adapter\AdapterInterface,
    Zend\Authentication\Result;

use Doctrine\ORM\EntityManager;

use Livraria\Entity\User;

class Adapter implements AdapterInterface{
    /**
     *
     * @var EntityManager 
     */
    protected $em;
    protected $username;
    protected $password;
    
    public function __construct(EntityManager $em) {
        $this->em = $em;
    }
    
    function getUsername() {
        return $this->username;
    }

    function getPassword() {
        return $this->password;
    }

    function setUsername($username) {
        $this->username = $username;
        return $this;
    }

    function setPassword($password) {
        $this->password = $password;
        return $this;
    }

    public function authenticate() {
        $repository = $this->em->getRepository(\Livraria\Entity\User::class);
        $user = $repository->findByEmailAndPassword($this->getUsername(), $this->getPassword());
        
        if($user){
            return new Result(Result::SUCCESS, ['user'=>$user], ['OK']);
        }else{
            return new Result(Result::FAILURE_CREDENTIAL_INVALID, null, []);
        }
    }

}
