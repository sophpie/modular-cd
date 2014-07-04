<?php
return array(
	'controllers' => array(
		'invokables' => array(
			'jenkins-job' => 'Extension\Jenkins\Controller\Job',
		),
	),
    'hal_mapper' => array(
    		'Jenkins\Model\Device\Jenkins' => array(
    				'controller' => 'device',
    				'extraMapping' => array(
    						'assocs' => array('jobs','overallLoad'),
    						'properties' => array(),
    				),
    		),
	),
);
