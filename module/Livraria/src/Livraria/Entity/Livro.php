<?php

namespace Livraria\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="livros")
 * @ORM\Entity(repositoryClass="Livraria\Entity\LivroRepository")
 */
class Livro {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @var int
     */
    protected $id;
    /**
     * @ORM\Column(type="text")
     * @var string 
     */
    protected $nome;
    /**
     * @ORM\ManyToOne(targetEntity="Livraria\Entity\Categoria", inversedBy="livro")
     * @ORM\JoinColumn(name="categoria_id", referencedColumnName="id")
     */
    protected $categoria;
    /**
     * @ORM\Column(type="text")
     * @var string 
     */
    protected $autor;
    /**
     * @ORM\Column(type="text")
     * @var string 
     */
    protected $isbn;
    /**
     * @ORM\Column(type="float")
     * @var float 
     */
    protected $valor;
    
    public function __construct($options = null) {
        Configurator::configure($this, $options);
    }
    
    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getCategoria() {
        return $this->categoria;
    }

    function getAutor() {
        return $this->autor;
    }

    function getIsbn() {
        return $this->isbn;
    }

    function getValor() {
        return $this->valor;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

    function setAutor($autor) {
        $this->autor = $autor;
    }

    function setIsbn($isbn) {
        $this->isbn = $isbn;
    }

    function setValor($valor) {
        $this->valor = $valor;
    }
    
    public function toArray(){
        return [
            'id'=>$this->getId(),
            'nome'=>$this->getNome(),
            'autor'=>$this->getAutor(),
            'isbn'=>$this->getIsbn(),
            'valor'=>$this->getValor(),
            'categoria' => $this->getCategoria()->getId(),
        ];
    }
}
