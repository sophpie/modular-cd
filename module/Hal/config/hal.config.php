<?php
return array(
		'service_manager' => array(
			'factories' => array(
				'hal_resource_factory' => 'Hal\Service\ResourceFactoryFactory',
			),
		),
		
		'controller_plugins' => array(
				'invokables' => array(
						'Doctrine2Hal' => 'Hal\Controller\Plugin\Doctrine2Hal',
				)
		),
);
