<?php

namespace Extension\GitHub;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;

class Module implements AutoloaderProviderInterface
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/GitHub',
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/github.config.php';
    }
}
