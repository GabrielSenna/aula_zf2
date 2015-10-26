<?php

namespace LivrariaAdmin\Controller;


class CategoriasController extends CrudController{
    
    public function __construct() {
        $this->entity = \Livraria\Entity\Categoria::class;
        $this->form = \LivrariaAdmin\Form\Categoria::class;
        $this->service = \Livraria\Service\Categoria::class;
        $this->controller = 'categorias';
        $this->route = 'livraria-admin';
    }
}
