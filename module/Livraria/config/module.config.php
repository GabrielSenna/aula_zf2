<?php

namespace Livraria;

return array(
    'router' => array(
        'routes' => array(
            'livraria-home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/livraria',
                    'defaults' => array(
                        'controller' => 'Livraria\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            'livraria-admin-interna' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/admin/[:controller[/:action]][/:id]',
                    'constraints'=>[
                        'id'=>'[0-9]+',
                    ]
                ),
            ),
            'livraria-admin' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/admin/[:controller[/:action][/page/:page]]',
                    'defaults' => array(
                        'action'     => 'index',
                        'page'=> 1,
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Livraria\Controller\Index' => \Livraria\Controller\IndexController::class,
            'categorias' => \LivrariaAdmin\Controller\CategoriasController::class,
            'livros' => \LivrariaAdmin\Controller\LivrosController::class,
            'users' => \LivrariaAdmin\Controller\UsersController::class,
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'livraria/index/index' => __DIR__ . '/../view/livraria/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
    'doctrine'=> [
        'driver'=> [
            __NAMESPACE__.'_driver'=> [
                'class'=>'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache'=>'array',
                'paths'=> [__DIR__.'/../src/'.__NAMESPACE__.'/Entity']
            ],
            'orm_default'=> [
                'drivers'=> [
                    __NAMESPACE__.'\Entity'=> __NAMESPACE__.'_driver'
                ]
            ]
        ]
    ]
);
