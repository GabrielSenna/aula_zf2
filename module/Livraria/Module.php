<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Livraria;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

use Livraria\Model\CategoriaTable;
use Livraria\Model\LivroTable;

use Livraria\Service\Categoria as CategoriaService;
use Livraria\Service\Livro as LivroService;
use Livraria\Service\User as UserService;

use LivrariaAdmin\Form\Livro as LivroFrm;

class Module
{
    
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__.'Admin' => __DIR__ . '/src/' . __NAMESPACE__.'Admin',
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    public function getServiceConfig(){
        return [
            'factories'=> [
                'Livraria\Model\CategoriaService'=> function($service){
                    $dbAdapter = $service->get('Zend\Db\Adapter\Adapter');
                    $categoriaTable = new CategoriaTable($dbAdapter);
                    $CategoriaService = new Model\CategoriaService($categoriaTable);
                    return $CategoriaService;
                },
                'Livraria\Service\Categoria'=> function($service){
                    return new CategoriaService($service->get('Doctrine\ORM\EntityManager'));
                },
                'Livraria\Service\Livro'=> function($service){
                    return new LivroService($service->get('Doctrine\ORM\EntityManager'));
                },
                'Livraria\Service\User'=> function($service){
                    return new UserService($service->get('Doctrine\ORM\EntityManager'));
                },
                'LivrariaAdmin\Form\Livro'=> function($service){
                    $em = $service->get(\Doctrine\ORM\EntityManager::class);
                    $repository = $em->getRepository(\Livraria\Entity\Categoria::class);
                    $categorias = $repository->fetchPairs();
                    return new LivroFrm(null, $categorias);
                },
            ]
        ];
    }
}
