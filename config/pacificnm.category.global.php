<?php 
return array(
    'module' => array(
        'Category' => array(
            'name' => 'Category',
            'version' => '1.0.0',
            'install' => array(
                'require' => array(),
                'sql' => 'sql/category.sql'
            )
        )
    ),
    'controllers' => array(
        'factories' => array(
            'Pacificnm\Category\Controller\BrowseController' => 'Pacificnm\Category\Controller\Factory\BrowseControllerFactory',
            'Pacificnm\Category\Controller\ConsoleController' => 'Pacificnm\Category\Controller\Factory\ConsoleControllerFactory',
            'Pacificnm\Category\Controller\CreateController' => 'Pacificnm\Category\Controller\Factory\CreateControllerFactory',
            'Pacificnm\Category\Controller\DeleteController' => 'Pacificnm\Category\Controller\Factory\DeleteControllerFactory',
            'Pacificnm\Category\Controller\IndexController' => 'Pacificnm\Category\Controller\Factory\IndexControllerFactory',
            'Pacificnm\Category\Controller\RestController' => 'Pacificnm\Category\Controller\Factory\RestControllerFactory',
            'Pacificnm\Category\Controller\UpdateController' => 'Pacificnm\Category\Controller\Factory\UpdateControllerFactory',
            'Pacificnm\Category\Controller\ViewController' => 'Pacificnm\Category\Controller\Factory\ViewControllerFactory'
        )
    ),
    'service_manager' => array(
        'factories' => array(
            'Pacificnm\Category\Service\ServiceInterface' => 'Pacificnm\Category\Service\Factory\ServiceFactory',
            'Pacificnm\Category\Mapper\MysqlMapperInterface' => 'Pacificnm\Category\Mapper\Factory\MysqlMapperFactory',
            'Pacificnm\Category\Form\Form' => 'Pacificnm\Category\Form\Factory\FormFactory',
        )
    ),
    'router' => array(
        'routes' => array(
            'category-browse' => array(
                'pageTitle' => 'Browse',
                'pageSubTitle' => '',
                'activeMenuItem' => '',
                'activeSubMenuItem' => '',
                'icon' => 'fa fa-list',
                'layout' => 'layout',
                'type' => 'segment',
                'options' => array(
                    'route' => '/browse[/:categorySlug1][/:categorySlug2][/:categorySlug3][/:categorySlug4]',
                    'defaults' => array(
                        'controller' => 'Pacificnm\Category\Controller\BrowseController',
                        'action' => 'index'
                    )
                )
            ),
            'category-create' => array(
                'pageTitle' => 'Category',
                'pageSubTitle' => 'New',
                'activeMenuItem' => 'admin-index',
                'activeSubMenuItem' => 'category-index',
                'icon' => 'fa fa-list',
                'layout' => 'admin',
                'type' => 'literal',
                'options' => array(
                    'route' => '/admin/category/create',
                    'defaults' => array(
                        'controller' => 'Pacificnm\Category\Controller\CreateController',
                        'action' => 'index'
                    )
                )
            ),
            'category-delete' => array(
                'pageTitle' => 'Category',
                'pageSubTitle' => 'Delete',
                'activeMenuItem' => 'admin-index',
                'activeSubMenuItem' => 'category-index',
                'icon' => 'fa fa-list',
                'layout' => 'admin',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/category/delete/[:id]',
                    'defaults' => array(
                        'controller' => 'Pacificnm\Category\Controller\DeleteController',
                        'action' => 'index'
                    )
                )
            ),
            'category-index' => array(
                'pageTitle' => 'Category',
                'pageSubTitle' => 'Home',
                'activeMenuItem' => 'admin-index',
                'activeSubMenuItem' => 'category-index',
                'icon' => 'fa fa-list',
                'layout' => 'admin',
                'type' => 'literal',
                'options' => array(
                    'route' => '/admin/category',
                    'defaults' => array(
                        'controller' => 'Pacificnm\Category\Controller\IndexController',
                        'action' => 'index'
                    )
                )
            ),
            'category-rest' => array(
                'pageTitle' => 'Category',
                'pageSubTitle' => 'Rest',
                'activeMenuItem' => 'admin-index',
                'activeSubMenuItem' => 'category-index',
                'icon' => 'fa fa-list',
                'layout' => 'rest',
                'type' => 'segment',
                'options' => array(
                    'route' => '/api/category[/:id]',
                    'defaults' => array(
                        'controller' => 'Pacificnm\Category\Controller\RestController'
                    )
                )
            ),
            'category-update' => array(
                'pageTitle' => 'Category',
                'pageSubTitle' => 'Edit',
                'activeMenuItem' => 'admin-index',
                'activeSubMenuItem' => 'category-index',
                'icon' => 'fa fa-list',
                'layout' => 'admin',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/category/update/[:id]',
                    'defaults' => array(
                        'controller' => 'Pacificnm\Category\Controller\UpdateController',
                        'action' => 'index'
                    )
                )
            ),
            'category-view' => array(
                'pageTitle' => 'Category',
                'pageSubTitle' => 'View',
                'activeMenuItem' => 'admin-index',
                'activeSubMenuItem' => 'category-index',
                'icon' => 'fa fa-list',
                'layout' => 'admin',
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin/category/view/[:id]',
                    'defaults' => array(
                        'controller' => 'Pacificnm\Category\Controller\ViewController',
                        'action' => 'index'
                    )
                )
            )
        )
    ),
    'console' => array(
        'router' => array(
            'routes' => array(
                'category-console-index' => array(
                    'options' => array(
                        'route' => 'category',
                        'defaults' => array(
                            'controller' => 'Pacificnm\Category\Controller\ConsoleController',
                            'action' => 'index'
                        )
                    )
                )
            )
        ),
    ),
    'view_manager' => array(
        'controller_map' => array(
            'Pacificnm\Category' => true
        ),
        'template_map' => array(
            'pacificnm/category/browse/index' => __DIR__ . '/../view/category/browse/index.phtml',
            'pacificnm/category/create/index' => __DIR__ . '/../view/category/create/index.phtml',
            'pacificnm/category/delete/index' => __DIR__ . '/../view/category/delete/index.phtml',
            'pacificnm/category/index/index' => __DIR__ . '/../view/category/index/index.phtml',
            'pacificnm/category/update/index' => __DIR__ . '/../view/category/update/index.phtml',
            'pacificnm/category/view/index' => __DIR__ . '/../view/category/view/index.phtml'
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view'
        )
    ),
    'view_helpers' => array(
        'factories' => array(
            'CategorySearchForm' => 'Pacificnm\Category\View\Helper\Factory\CategorySearchFormFactory',
            'Category' => 'Pacificnm\Category\View\Helper\Factory\CategoryHelperFactory',
        )
    ),
    'acl' => array(
        'default' => array(
            'guest' => array(
                'category-browse'
            ),
            'user' => array(
                'category-browse'
            ),
            'administrator' => array(
                'category-browse',
                'category-create',
                'category-delete',
                'category-index',
                'category-update',
                'category-view'
            )
        )
    ),
    'menu' => array(
        'default' => array(
            array(
                'key' => 'admin',
                'name' => 'Admin',
                'icon' => 'fa fa-gear',
                'order' => 99,
                'active' => true,
                'location' => 'left',
                'items' => array(
                    array(
                        'key' => 'category-index',
                        'name' => 'Category',
                        'route' => 'category-index',
                        'icon' => 'fa fa-list',
                        'order' => 3,
                        'active' => true,
                    )
                )
            )
        )
    ),
    'navigation' => array(
        'default' => array(
            array(
                'label' => 'Home',
                'route' => 'home',
                'useRouteMatch' => true,
                'pages' => array(
                    array(
                        'label' => 'Browse',
                        'route' => 'category-browse',
                        'useRouteMatch' => true,
                    )
                )
            ),
            array(
                'label' => 'Admin',
                'route' => 'admin-index',
                'useRouteMatch' => true,
                'pages' => array(
                    array(
                        'label' => 'Category',
                        'route' => 'category-index',
                        'useRouteMatch' => true,
                        'pages' => array(
                            array(
                                'label' => 'View',
                                'route' => 'category-view',
                                'useRouteMatch' => true,
                                'pages' => array(
                                    array(
                                        'label' => 'Edit',
                                        'route' => 'category-update',
                                        'useRouteMatch' => true,
                                    ),
                                    array(
                                        'label' => 'Delete',
                                        'route' => 'category-delete',
                                        'useRouteMatch' => true,
                                    )
                                )
                            ),
                            array(
                                'label' => 'New',
                                'route' => 'category-create',
                                'useRouteMatch' => true,
                            )
                        )
                    )
                )
            )
        )
    )
);