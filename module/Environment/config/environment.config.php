<?php
return array(
	'controllers' => array(
		'invokables' => array(
			'environment' => 'Environment\Controller\EnvironmentController',
			'device' => 'Environment\Controller\DeviceController'
		),
	),
		
	'hal_mapper' => array(
		'Environment\Model\Environment' => array(
				'controller' => 'environment',
		),
		'Environment\Model\Device\Device' => array(
				'controller' => 'device',
				'extraMapping' => array(
    						'assocs' => array('deviceClass'),
    						'properties' => array(),
    				),
		),
	),
);
