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
		$resourceFactory = new ResourceFactory();
		$resourceFactory->setServiceLocator($serviceLocator);
		return $resourceFactory;
	}
}