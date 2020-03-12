<?php

use Certificate\Controller\CertificateController;
use Certificate\Controller\Factory\CertificateControllerFactory;
use Certificate\Service\Factory\CertificateModelPrimaryAdapterFactory;
use Midnet\View\Helper\Functions;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'certificate' => [
                'type' => Literal::class,
                'priority' => 1,
                'options' => [
                    'route' => '/certificates',
                    'defaults' => [
                        'action' => 'index',
                        'controller' => CertificateController::class,
                    ],
                ],
                'may_terminate' => TRUE,
                'child_routes' => [
                    'default' => [
                        'type' => Segment::class,
                        'priority' => -100,
                        'options' => [
                            'route' => '/[:action[/:uuid]]',
                            'defaults' => [
                                'action' => 'index',
                                'controller' => CertificateController::class,
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'acl' => [
        'guest' => [
        ],
        'member' => [
            'certificate' => ['index'],
            'certificate/default' => ['index', 'create', 'update', 'delete'],
        ],
    ],
    'controllers' => [
        'factories' => [
            CertificateController::class => CertificateControllerFactory::class,
        ],
    ],
    'navigation' => [
        'default' => [
            'certificate' => [
                'label' => 'Certificates',
                'route' => 'home',
                'class' => 'dropdown',
                'pages' => [
                    [
                        'label' => 'Certificate Maintenance',
                        'route' => 'certificate/default',
                        'class' => 'dropdown-submenu',
                        'pages' => [
                            [
                                'label' => 'Add Certificate',
                                'route' => 'certificate/default',
                                'action' => 'create',
                            ],
                            [
                                'label' => 'List Certificates',
                                'route' => 'certificate/default',
                                'action' => 'index',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'service_manager' => [
        'aliases' => [
            'certificate-model-primary-adapter-config' => 'model-primary-adapter-config',
        ],
        'factories' => [
            'certificate-model-primary-adapter' => CertificateModelPrimaryAdapterFactory::class,
        ],
    ],
    'view_helpers' => [
        'aliases' => [
            'functions' => Functions::class,
        ],
        'factories' => [
            Functions::class => InvokableFactory::class,
        ],
    ],
    'view_manager' => [
        'template_map' => [
            'certificate/context_report' => __DIR__ . '/../view/certificate/partials/context_report.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];