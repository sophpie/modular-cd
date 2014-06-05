<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'repository' => 'Repository\Controller\IndexController',
        ),
    ),
    'collections_mapper' => array(
        'repository' => array(
            'Repository\Model\GitHub' => array(), 	
        ),
    ),
);
