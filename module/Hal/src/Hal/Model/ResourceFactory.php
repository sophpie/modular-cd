<?php
namespace Hal\Model;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Hal\Model\Resource;
use Doctrine\ODM\MongoDB\Cursor;

class ResourceFactory implements ServiceLocatorAwareInterface
{
	/**
	 * Service locator
	 * 
	 * @var ServiceLocatorInterface
	 */
	protected $serviceLocator;
	
	/**
	 * (non-PHPdoc)
	 * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::setServiceLocator()
	 */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
    	$this->serviceLocator = $serviceLocator;
    }

    /**
     * (non-PHPdoc)
     * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::getServiceLocator()
     */
    public function getServiceLocator()
    {
    	return $this->serviceLocator;
    }
    
    /**
     * Get document manager
     * 
     * @return Ambigous <object, multitype:, doctrine.documentmanager.odm_default>
     */
    protected function getDm()
    {
    	return $this->getServiceLocator()->get('doctrine.documentmanager.odm_default');
    }
    
    
    /**
     * Create resource object from doctrine odm document
     * 
     * @param document $document
     * @param string $selfHref : self href link
     */
    public function fromDoctrineDocument($document)
    {
    	$resource = new Resource();
    	$class = get_class($document);
    	$metada = $this->getDm()
    		->getMetadataFactory()
			->getMetadataFor($class);
    	foreach ($metada->getFieldNames() as $field){
    		if (in_array($field, $metada->getAssociationNames())) continue;
    		$getter = 'get' . ucfirst($field);
    		$value = $document->$getter();
    		$resource->addProperty($field, $value);
    	}
    	foreach ($metada->getAssociationNames() as $assoc){
    		$getter = 'get' . ucfirst($assoc);
    		$collection = $document->$getter();
    		$embeddedArray = array();
    		foreach ($collection as $id => $item){
    			$embeddedResource = $this->fromDoctrineDocument($item);
    			$embeddedArray[] = $embeddedResource;
    		}
    		$resource->addEmbbeded($assoc, $embeddedArray);
    	}
    	return $resource;
    }
    
    /**
     * Create resource from Doctrine  odm cursor
     * 
     * @param Cursor $cursor
     * @param array|string $hrefs
     */
    public function fromDoctrineCursor ($cursor,$name)
    {
    	$resource = new Resource();
    	$embeddedArray = array();
    	foreach ($cursor as $id => $item){
    		$embeddedResource = $this->fromDoctrineDocument($item);
    		$embeddedArray[] = $embeddedResource;
    	}
    	$resource->addEmbbeded($name, $embeddedArray);
    	return $resource;
    }
}