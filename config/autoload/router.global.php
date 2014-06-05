<?php
return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                    )
                ),
                'may_terminate' => true,
                'child_routes' => array(
                		'default' => array(
                				'type' => 'Segment',
                				'options' => array(
                						'route' => '[:controller[/:id]]',
                						'constraints' => array(
                								'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                						)
                				)
                		)
                )
            ),
            
        )
    )
    
);
