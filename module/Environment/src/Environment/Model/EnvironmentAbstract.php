<?php
namespace Environment\Model;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Environment\Model\Device\DeviceAbstract;
use Common\Model\PersistentInterface;
use Doctrine\Common\Collections\ArrayCollection;

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
     * Environment description
     * 
     * @ODM\String
     * @var string
     */
    protected $description;
    
    /**
     * Array of devices
     * 
     * @ODM\ReferenceMany(targetDocument="Environment\Model\Device\Device")
     * @var ArtrayCollection
     */
    protected $devices;
    
    /**
     * Constructor 
     */
    public function __construct()
    {
    	$this->devices = new ArrayCollection();
    }
    
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
		$this->getDevices()->add($device);
	}
	
	/**
	 * remove a device
	 * 
	 * @param DeviceAbstract $device
	 */
	public function removeDevice(DeviceAbstract $device)
	{
		foreach ($this->getDevices() as $key => $d) {
			if ($d->getId() == $device->getId()){
				$this->getDevices()->remove($key);
			}
		}
	}
	/**
	 * @return the $description
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * @param string $description
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

}