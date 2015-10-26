<?php

namespace Livraria\Service;

use Doctrine\ORM\EntityManager;
use Livraria\Entity\Categoria as CategoriaService;

use Livraria\Entity\Configurator;

class Categoria extends AbstractService{
    public function __construct(EntityManager $em) {
        parent::__construct($em);
        $this->entity = \Livraria\Entity\Categoria::class;
    }
}
