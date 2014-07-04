<?php
namespace Environment\Model\Device;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Common\Model\PersistentInterface;
use Environment\Model\EnvironmentAbstract;

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
	 * Environment
	 * 
	 * @ODM\ReferenceOne(targetDocument="Environment\Model\Environment")
	 * @var EnvironmentAbstract
	 */
	protected $environment;
	
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
	
	/**
	 * @return the $environment
	 */
	public function getEnvironment() {
		return $this->environment;
	}

	/**
	 * @param \Environment\Model\EnvironmentAbstract $environment
	 */
	public function setEnvironment($environment) {
		$this->environment = $environment;
	}
	
	/**
	 * 
	 * @return string
	 */
	public function getDeviceClass()
	{
		return get_class($this);
	}

}