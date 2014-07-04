<?php
return array(
    'hal_mapper' => array(
		'Extension\GitHub\Model\Device\GitHub' => array(
				'controller' => 'device',
				'extraMapping' => array(
						'assocs' => array('repository'),
						'properties' => array(),
				),
		),
	),
);
