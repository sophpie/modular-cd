<?php
namespace Extension\GitHub\Model\Device;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Environment\Model\Device\Device;

/** @ODM\Document */
class GitHub extends Device
{
	/**
	 * Device type identifier
	 *
	 * @var string
	 */
	protected $deviceType = 'github';
}
