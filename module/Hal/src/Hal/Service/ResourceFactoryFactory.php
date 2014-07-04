<?php
namespace Hal\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Hal\Model\ResourceFactory;

class ResourceFactoryFactory implements FactoryInterface
{
	/**
	 * (non-PHPdoc)
	 * @see \Zend\ServiceManager\FactoryInterface::createService()
	 */
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$config = $serviceLocator->get('config');
		$halMapping = $config['hal_mapper'];
		$resourceFactory = new ResourceFactory($halMapping);
		$resourceFactory->setServiceLocator($serviceLocator);
		return $resourceFactory;
	}
}