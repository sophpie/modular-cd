<?php
return array(
    'doctrine' => array(
        
        'connection' => array(
            'odm_default' => array()
            // 'server' => 'localhost',
            // 'port' => '27017',
            // 'connectionString' => null,
            // 'user' => null,
            // 'password' => null,
            // 'dbname' => null,
            // 'options' => array()
            
        ),
        
        'configuration' => array(
            'odm_default' => array(
            // 'metadata_cache' => 'array',
            //
            // 'driver' => 'odm_default',
            //
            // 'generate_proxies' => false,
            // 'proxy_dir' => 'data/DoctrineMongoODMModule/Proxy',
            // 'proxy_namespace' => 'DoctrineMongoODMModule\Proxy',
            //
            // 'generate_hydrators' => true,
            // 'hydrator_dir' => 'data/DoctrineMongoODMModule/Hydrator',
            // 'hydrator_namespace' => 'DoctrineMongoODMModule\Hydrator',
            //
            'default_db' => 'cronus',
            //
            // 'filters' => array(), // array('filterName' => 'BSON\Filter\Class'),
            //
            // 'logger' => null // 'DoctrineMongoODMModule\Logging\DebugStack'
            )
        ),
        
        'driver' => array(
            'odm_default' => array(
                'drivers' => array(
                    'Repository\Model\GitHub\GitHubRepository' => 'cronus_odm',
                	'Environment\Model\Environment' => 'cronus_odm',
                	'Environment\Model\Device\Device' => 'cronus_odm',
                	'Extension\Jenkins\Model\Device\Jenkins' => 'cronus_odm',
                	'Extension\GitHub\Model\Device\GitHub' => 'cronus_odm',
                )
            )
            ,
            'cronus_odm' => array(
                'class' => 'Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver',
                'paths' => array(
                    'Repository\Model\GitHub\GitHubRepository',
                    //'Environment\Model\Environment'
                )
            )
        ),
        
        'documentmanager' => array(
            'odm_default' => array()
            // 'connection' => 'odm_default',
            // 'configuration' => 'odm_default',
            // 'eventmanager' => 'odm_default'
            
        ),
        
        'eventmanager' => array(
            'odm_default' => array(
                'subscribers' => array()
            )
        )
    )
);