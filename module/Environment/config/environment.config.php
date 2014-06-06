<?php
return array(
	'controllers' => array(
		'invokables' => array(
			'environment' => 'Environment\Controller\EnvironmentController',
			'device' => 'Environment\Controller\DeviceController'
		),
	),
		
	'hal_mapper' => array(
		'Environment\Model\Environment' => 'environment',
		'Environment\Model\Device\Device' => 'device',
		'Environment\Model\Device\Jenkins' => 'device',
	),
);
