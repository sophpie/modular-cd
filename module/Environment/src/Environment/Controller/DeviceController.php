<?php
namespace Environment\Controller;

use Common\Controller\ControllerAbstract;
use Environment\Model\Device\Device;
use Hal\Model\Resource;


class DeviceController extends ControllerAbstract
{
	protected $documentClassName = 'Environment\Model\Device\Device';
	
	/**
	 * (non-PHPdoc)
	 * @see \Common\Controller\ControllerAbstract::create()
	 */
	public function create($data)
	{
		$device = parent::create($data);
		if (isset($data['environment'])){
			$environment = $this->getDocumentManager()->find('Environment\Model\Environment',$data['environment']);
			$environment->addDevice($device);
			$device->setEnvironment($environment);
			$this->getDocumentManager()->persist($environment);
		}
		return $device;
	}
	
	/**
	 * Retunr device informtion
	 * 
	 * @return array
	 */
	public function infoAction()
	{
		$resource = new Resource();
		$resource->addLink(Resource::LINK_TYPE_SELF, '/info/device');
		$resource->addProperty('availableDevices', array(
				'jenkins','zendserver','github','openshift',
		));
		return $resource;
	}
	/**
	 * (non-PHPdoc)
	 * @see \Common\Controller\ControllerAbstract::delete()
	 */
	public function delete($id)
	{
		$deleted = parent::delete($id);
		$environment = $deleted->getEnvironment();
		$environment->removeDevice($deleted);
		$this->getDocumentManager()->persist($environment);
		return $deleted;
	}
}
