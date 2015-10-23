<?php

namespace Livraria\Service;

use Doctrine\ORM\EntityManager;
use Livraria\Entity\Categoria as Cat;

class Categoria {
    /**
     * @var EntityManager
     */
    protected $em;
    
    public function __construct(EntityManager $em) {
        $this->em = $em;
    }
    
    public function insert(array $data){
        $entity = new Cat($data);
        $this->em->persist($entity);
        $this->em->flush();
        return $entity;
    }
    
}
