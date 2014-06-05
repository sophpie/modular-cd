<?php
namespace Hal\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Hal\Model\Resource;
use Doctrine\ODM\MongoDB\Cursor;
use Hal\Model\ResourceFactory;

class Doctrine2Hal extends AbstractPlugin
{
	/**
	 * Base url for hrefs links
	 * 
	 * @var string
	 */
	protected $baseUrl;
	
	
	/**
	 * Invoke plugin
	 * 
	 * @param array $args
	 */
	public function __invoke($doctrineObject = null)
	{
		if ( ! $doctrineObject) return $this;
		return $this->convert($doctrineObject);
	}
	
	/**
	 * Convert Doctrine object to hal resource
	 * 
	 * @param unknown $doctrineObject
	 */
	public function convert($doctrineObject)
	{
		if ($doctrineObject instanceof Cursor)
			return $this->convertCursor($doctrineObject);
		if (is_array($doctrineObject))
			return $this->convertCursor($doctrineObject);
		return $this->convertObject($doctrineObject);
	}
	
	/**
	 * Get resource factory service
	 * 
	 * @return ResourceFactory
	 */
	protected function getHalResourceFactory()
	{
		return $this->getController()->getServiceLocator()->get('hal_resource_factory');
	}
	
	/**
	 * Return base url from controller
	 * 
	 * @return string
	 */
	protected function getBaseUrl()
	{
		if ( ! $this->baseUrl) $this->baseUrl = $this->getController()->getRequest()->getUriString();
		return trim($this->baseUrl,'/') . '/';
	}
	
	/**
	 * Get Hal collection name from controller
	 * 
	 * @return string
	 */
	protected function getHalCollectionName()
	{
		return $this->getController()->getEvent()->getRouteMatch()->getParam('controller') . 's';
	}
	
	/**
	 * Set base url
	 * 
	 * @param string $baseUrl
	 */
	public function setBaseUrl($baseUrl)
	{
		$this->baseUrl = $baseUrl;
	}
	
	/**
	 * Convert a Doctrine Document to Hal resource
	 * 
	 * @param mixed $object
	 * @return \Hal\Controller\Plugin\Resource
	 */
	protected function convertObject($object)
	{
		$resource = $this->getHalResourceFactory()->fromDoctrineDocument($object);
		$resource->addLink(Resource::LINK_TYPE_SELF, $this->getBaseUrl() . $object->getId());
		$this->setEmbeddedLinks($resource);
		return $resource;
	}
	
	/**
	 * Set embedded links
	 * 
	 * @param resource $resource
	 */
	protected function setEmbeddedLinks($resource)
	{
		foreach ($resource->getEmbedded() as $embedded){
			if (is_array($embedded)){
				foreach ($embedded as $subEmb){
					$id = $subEmb->getProperty('id');
					$subEmb->addLink(Resource::LINK_TYPE_SELF, $this->getBaseUrl() . $id);
				}
			}
			else {
				$id = $embedded->getProperty('id');
				$embedded->addLink(Resource::LINK_TYPE_SELF, $this->getBaseUrl() . $id);
			}
		}
	}
	
	/**
	 * Convert Doctrine Document cursor to Hal resource
	 * 
	 * @param unknown $collection
	 */
	protected function convertCursor($cursor)
	{
		$resource = $this->getHalResourceFactory()->fromDoctrineCursor($cursor,$this->getHalCollectionName());
		$resource->addLink(Resource::LINK_TYPE_SELF, $this->getBaseUrl());
		$this->setEmbeddedLinks($resource);
		return $resource;
	}
}