<?php
namespace Environment\Model;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Environment\Model\Device\DeviceAbstract;
use Common\Model\PersistentInterface;

/** @ODM\MappedSuperclass */
abstract class EnvironmentAbstract implements EnvironmentInterface, PersistentInterface
{
    use \Common\Model\PersistentTrait;
    
    /**
     * Environment name
     * 
     * @ODM\String
     * @var string
     */
    protected $name;
    
    /**
     * Array of devices
     * 
     * @ODM\ReferenceMany(targetDocument="Environment\Model\Device\Device")
     * @var array
     */
    protected $devices = array();
    
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
	 * @return the $devices
	 */
	public function getDevices() {
		return $this->devices;
	}

	/**
	 * @param multitype: $devices
	 */
	public function setDevices($devices) {
		$this->devices = $devices;
	}
	
	/**
	 * Adding a device
	 * 
	 * @param DeviceAbstract $device
	 */
	public function addDevice(DeviceAbstract $device)
	{
		$id = $device->getId();
		$this->devices[$id] = $device;
	}
}