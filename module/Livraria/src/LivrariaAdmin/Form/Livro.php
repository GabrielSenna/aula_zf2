<?php

namespace LivrariaAdmin\Form;

use Zend\Form\Form;

use Zend\Form\Element\Select;

use Doctrine\ORM\EntityManager;

class Livro extends Form{
    
    protected $categorias;
    public function __construct($name = null, array $categorias = null) {
        parent::__construct('livro');
        $this->categorias = $categorias;
        $this->setAttribute('method', 'post');
        //$this->setInputFilter(new CategoriaFilter);
        $this->add([
            'name'=> 'id',
            'attributes'=> [
                'type'=>'hidden'
            ]
        ]);
        $this->add([
            'name'=>'nome',
            'options'=>[
                'type'=>'text',
                'label'=>'Nome'
            ],
            'attributes'=>[
                'id'=>'nome',
                'placeholder'=>'Entre com o nome',
            ]
        ]);
        $categoria = new Select();
        $categoria->setLabel('Categoria')
                ->setName("categoria")
                ->setOptions([
                    'value_options'=> $this->categorias
                ]);
        $this->add($categoria);
        $this->add([
            'name'=>'autor',
            'options'=>[
                'type'=>'text',
                'label'=>'Autor'
            ],
            'attributes'=>[
                'id'=>'autor',
                'placeholder'=>'Entre com o nome do autor',
            ]
        ]);
        $this->add([
            'name'=>'isbn',
            'options'=>[
                'type'=>'text',
                'label'=>'ISBN'
            ],
            'attributes'=>[
                'id'=>'isbn',
                'placeholder'=>'Entre com o ISBN',
            ]
        ]);
        $this->add([
            'name'=>'valor',
            'options'=>[
                'type'=>'text',
                'label'=>'Valor'
            ],
            'attributes'=>[
                'id'=>'valor',
                'placeholder'=>'Entre com o valor',
            ]
        ]);
        $this->add([
            'name'=>'submit',
            'type'=> \Zend\Form\Element\Submit::class,
            'attributes'=> [
                'value'=> 'Salvar',
                'class'=> 'btn-success',
            ]
        ]);
    }
}
