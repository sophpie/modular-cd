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
                						'route' => '[:controller[/:id][/:action]]',
                						'constraints' => array(
                								'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                								'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                						)
                				)
                		),
                		
                		'info' => array(
                				'type' => 'Segment',
                				'options' => array(
                						'route' => 'info/:controller',
                						'defaults' => array(
                								'action' => 'info',
                						),
                						'constraints' => array(
                								'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                						)
                				)
                		),
                		
                )
            ),
            
        )
    )
    
);
