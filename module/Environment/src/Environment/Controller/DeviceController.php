<?php
namespace Environment\Controller;

use Common\Controller\ControllerAbstract;
use Environment\Model\Device\Device;


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
			$this->getDocumentManager()->persist($environment);
			$this->getDocumentManager()->flush();
		}
		return $device;
	}
}
