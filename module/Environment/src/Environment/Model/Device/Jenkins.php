<?php
namespace Environment\Model\Device;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use ZendPattern\Jenkins\CiServer;

/** @ODM\Document */
class Jenkins extends Device
{
	/**
	 * Ci server
	 * 
	 * @var CiServer
	 */
	protected $CiServer;
	
	
	
}