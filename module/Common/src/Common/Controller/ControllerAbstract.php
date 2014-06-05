<?php
namespace Common\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\Mvc\MvcEvent;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use Hal\Model\Resource;

abstract class ControllerAbstract extends AbstractRestfulController
{
	/**
	 * Linked document class name
	 * 
	 * @var string
	 */
	protected $documentClassName;
	
	/**
	 * Max response per page (collection)
	 * 
	 * @var integer
	 */
	protected $maxPerPage = 0;

	/**
	 * @return the $documentClassName
	 */
	public function getDocumentClassName() {
		$className = $this->params()->fromPost('__type__',false);
		if ( ! $className) return $this->documentClassName;
		else return $className;
	}

	/**
	 * @param string $documentClassName
	 */
	public function setDocumentClassName($documentClassName) {
		$this->documentClassName = $documentClassName;
	}

	/**
	 * @return the $maxPerPage
	 */
	public function getMaxPerPage() {
		return $this->maxPerPage;
	}

	/**
	 * @param number $maxPerPage
	 */
	public function setMaxPerPage($maxPerPage) {
		$this->maxPerPage = $maxPerPage;
	}

	/**
	 * Get document manager
	 * @return Ambigous <object, multitype:, doctrine.documentmanager.odm_default>
	 */
	public function getDocumentManager()
	{
		return $this->getServiceLocator()
			->get('doctrine.documentmanager.odm_default');
	}
	
	/**
	 * Get ODM metadata form document class
	 * 
	 * @return ClassMetadata
	 */
	public function getMetadata()
	{
		return $this->getDocumentManager()
			->getMetadataFactory()
			->getMetadataFor($this->getDocumentClassName());
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Zend\Mvc\Controller\AbstractRestfulController::onDispatch()
	 */
	public function onDispatch(MvcEvent $e)
	{
		$result = parent::onDispatch($e);
		if ($result instanceof Resource) $resource = $result;
		else $resource = $this->doctrine2Hal($result);
		$response = $this->getResponse();
		$response->setContent(json_encode($resource,JSON_PRETTY_PRINT));
		return $response;
	}
	
	/**
	 * Get current page
	 * 
	 * @return number
	 */
	protected function getPage()
	{
		$page = $this->getRequest()->getQuery('page');
		if ( ! $page) $page = 1;
		return $page;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Zend\Mvc\Controller\AbstractRestfulController::getList()
	 */
	public function getList()
	{
		$page = $this->getPage();
		$queryBuilder = $this->getDocumentManager()
			->createQueryBuilder($this->getDocumentClassName());
		$queryBuilder->find()->limit($this->getMaxPerPage());
		if ($page != 1) $queryBuilder->skip($page * $this->getMaxPerPage());
		$cursor = $queryBuilder->getQuery()->execute();
		return $cursor;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Zend\Mvc\Controller\AbstractRestfulController::get()
	 */
	public function get($id)
	{
		$object = $this->getDocumentManager()->find($this->getDocumentClassName(),$id);
		if ( ! $object) return null;
		return $object;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Zend\Mvc\Controller\AbstractRestfulController::create()
	 */
	public function create($data)
	{
		$objectClass = $this->getDocumentClassName();
		$object = new $objectClass();
		foreach ($data as $key => $value){
			if ( ! in_array($key, $this->getMetadata()->getFieldNames())) continue;
			$setter = 'set' . ucfirst($key);
			$object->$setter($value);
		}
		$this->getDocumentManager()->persist($object);
		$this->getDocumentManager()->flush();
		return $object;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Zend\Mvc\Controller\AbstractRestfulController::update()
	 */
	public function update($id, $data)
	{
		$object = $this->getDocumentManager()->find($this->getDocumentClassName(),$id);
		if ( ! $object) return null;
		foreach ($data as $key => $value){
			if ( ! in_array($key, $this->getMetadata()->getFieldNames())) continue;
			$setter = 'set' . ucfirst($key);
			$object->$setter($value);
		}
		$this->getDocumentManager()->persist($object);
		$this->getDocumentManager()->flush();
		return $object;
	}
}