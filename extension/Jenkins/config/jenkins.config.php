<?php
return array(
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
