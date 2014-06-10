<?php
namespace Environment\Model\Device;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/** 
 * @ODM\Document(collection="device")
 * @ODM\InheritanceType("SINGLE_COLLECTION")
 * @ODM\DiscriminatorField(fieldName="__type__")
 * @ODM\DiscriminatorMap({
 *   "Jenkins\Model\Device\Jenkins"="Jenkins\Model\Device\Jenkins",
 * })
 */
class Device extends DeviceAbstract
{
	/**
	 * Static factory
	 * 
	 * @param string $class
	 * @return unknown
	 */
	public static function factory($class)
	{
		$device = new $class();
		return $device;
	}

}