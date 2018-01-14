<?php

namespace Meetup;

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
                                'controller' => Controller\MeetupController::class,
                                'action' => 'add',
                            ],
                        ],
                    ],
                    'delete' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/delete[/:id]',
                            'defaults' => [
                                'action' => 'delete',
                            ],
                            'constraints' => [
                                'id' => '[a-zA-Z0-9_-]*',
                            ],
                        ],
                    ],
                    'edit' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/edit[/:id]',
                            'defaults' => [
                                'controller' => Controller\MeetupController::class,
                                'action' => 'edit',
                            ],
                            'constraints' => [
                                'id' => '[a-zA-Z0-9_-]*',
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
            'meetup/index' => __DIR__ . '/../view/meetup/meetup/index.phtml',
            'meetup/add' => __DIR__ . '/../view/meetup/meetup/add.phtml',
            'meetup/edit' => __DIR__ . '/../view/meetup/meetup/edit.phtml',
        ],
        'template_path_stack' => [
            'meetup' => __DIR__ . '/../view',
        ],
    ],
];
