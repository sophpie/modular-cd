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
	protected  $name;
	
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
}