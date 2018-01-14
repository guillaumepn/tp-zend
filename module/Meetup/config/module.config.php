<?php

namespace Meetup;

use Meetup\Controller\MeetupController;
use Meetup\Controller\Factory\MeetupControllerFactory;
use Meetup\Service\Factory\MeetupManagerFactory;
use Meetup\Service\MeetupManager;
use Zend\Mvc\Application;
use Zend\Router\Http\Segment;
use Zend\Router\Http\Literal;

return [
    'router' => [
        'routes' => [
            'meetup' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/meetup',
                    'defaults' => [
                        'controller' => Controller\MeetupController::class,
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'add' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/add',
                            'defaults' => [
                                'action' => 'add',
                            ],
                        ],
                    ],
                    'delete' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/delete/:id',
                            'defaults' => [
                                'action' => 'delete',
                            ],
                            'constraints' => [
                                'id' => '\d+',
                            ],
                        ],
                    ],
                    'edit' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/edit/:id',
                            'defaults' => [
                                'action' => 'edit',
                            ],
                            'constraints' => [
                                'id' => '\d+',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],

    'controllers' => [
        'factories' => [
            Controller\MeetupController::class => Controller\Factory\MeetupControllerFactory::class,
        ],
    ],

    'service_manager' => [
        'factories' => [
            Service\MeetupManager::class => Service\Factory\MeetupManagerFactory::class,
        ],
    ],

    'doctrine' => [
        'driver' => [
            __NAMESPACE__ . '_driver' => [
                'class' => \Doctrine\ORM\Mapping\Driver\AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [
                    __DIR__ . '/../src/Entity/',
                ],
            ],

            'orm_default' => [
                'drivers' => [
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver',
                ],
            ],
        ],
    ],

    'view_manager' => [
        'template_map' => [
            'meetup/meetup/index' => __DIR__ . '/../view/meetup/meetup/index.phtml',
            'meetup/meetup/add' => __DIR__ . '/../view/meetup/meetup/add.phtml',
            'meetup/meetup/delete' => __DIR__ . '/../view/meetup/meetup/delete.phtml',
            'meetup/meetup/edit' => __DIR__ . '/../view/meetup/meetup/edit.phtml',
        ],
        'template_path_stack' => [
            'meetup' => __DIR__ . '/../view',
        ],
    ],
];
