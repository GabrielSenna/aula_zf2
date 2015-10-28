<?php

namespace LivrariaAdmin\Form;

use Zend\Form\Form;

use Zend\Form\Element\Select;

use Doctrine\ORM\EntityManager;

class Login extends Form{
    
    protected $categorias;
    public function __construct($name = null, array $categorias = null) {
        parent::__construct('livro');
        $this->categorias = $categorias;
        $this->setAttribute('method', 'post');
        //$this->setInputFilter(new CategoriaFilter);
        
        $this->add([
            'name'=>'email',
            'options'=>[
                'type'=>'email',
                'label'=>'Email'
            ],
            'attributes'=>[
                'id'=>'email',
                'placeholder'=>'Entre com o email',
            ]
        ]);
        $this->add([
            'name'=>'password',
            'options'=>[
                'type'=>'password',
                'label'=>'Senha'
            ],
            'attributes'=>[
                'id'=>'password',
                'type'=>'password',
            ]
        ]);
        $this->add([
            'name'=>'submit',
            'type'=> \Zend\Form\Element\Submit::class,
            'attributes'=> [
                'value'=> 'Entrar',
                'class'=> 'btn-success',
            ]
        ]);
    }
}
