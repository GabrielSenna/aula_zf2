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
use Livraria\Model\categoriaTable;

use Livraria\Service\Categoria as CategoriaService;

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
                    $categoriaTable = new categoriaTable($dbAdapter);
                    $CategoriaService = new Model\CategoriaService($categoriaTable);
                    return $CategoriaService;
                },
                'Livraria\Service\Categoria'=> function($service){
                    return new CategoriaService($service->get('Doctrine\ORM\EntityManager'));
                },
            ]
        ];
    }
}
