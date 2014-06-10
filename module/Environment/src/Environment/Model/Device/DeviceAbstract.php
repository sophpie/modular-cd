<?php
namespace Environment\Model\Device;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Common\Model\PersistentInterface;

/** 
 * @ODM\MappedSuperclass
 */
abstract class DeviceAbstract implements PersistentInterface
{
	use \Common\Model\PersistentTrait;
	
	/**
	 * Device name
	 * 
	 * @ODM\String
	 * @var string
	 */
	protected $name;
	
	/**
	 * Device type identifer
	 * 
	 * @ODM\String
	 * @var string
	 */
	protected $deviceType;
	
	/**
	 * @return the $name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param string $name
	 */
	public function setName($name) {
		$this->name = $name;
	}
	
	/**
	 * @return the $deviceType
	 */
	public function getDeviceType() {
		return $this->deviceType;
	}

	/**
	 * @param string $deviceType
	 */
	public function setDeviceType($deviceType) {
		$this->deviceType = $deviceType;
	}

}