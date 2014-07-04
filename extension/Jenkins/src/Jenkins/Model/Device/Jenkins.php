<?php
namespace Extension\Jenkins\Model\Device;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use ZendPattern\Jenkins\ApiManager;
use Environment\Model\Device\Device;
use Zend\Uri\Http as HttpUri;

/** @ODM\Document */
class Jenkins extends Device
{
	/**
	 * Device type identifier
	 * 
	 * @var string
	 */
	protected $deviceType = 'jenkins';
	
	/**
	 * Jenkins server url
	 * 
	 * @ODm\String
	 * @var string
	 */
	protected $url;
	
	
	/**
	 * Jenkins API Manager
	 * 
	 * @var ApiManager
	 */
	protected $apiManager;
	
	/**
	 * Gets jobs list
	 * 
	 * @return array
	 */
	public function getJobs()
	{
		$jobList = $this->getApiManager()->getJobList();
		$result = array();
		foreach ($jobList['jobs'] as $job ){
			$name = $job['name'];
			$result[] = $this->getJob($name);
		}
		return $result;
	}
	
	/**
	 * Get job detail
	 * 
	 * @param unknown $jobName
	 * @return Ambigous <multitype:, mixed>
	 */
	public function getJob($jobName)
	{
		return $this->getApiManager()->getJob($jobName);
	}
	
	/**
	 * Get pverallLoad statistics
	 * @return array
	 */
	public function getOverallLoad()
	{
		$stats = $this->getApiManager()->getStatistics();
		return  $stats;
	}
	
	/**
	 * @return the $apiManager
	 */
	public function getApiManager() {
		if ( ! $this->apiManager){
			$uri = new HttpUri();
			$uri->parse($this->getUrl());
			$this->apiManager = new ApiManager();
			$this->apiManager->setUri($uri);
		}
		return $this->apiManager;
	}

	/**
	 * @param \ZendPattern\Jenkins\ApiManager $apiManager
	 */
	public function setApiManager($apiManager) {
		$this->apiManager = $apiManager;
	}
	
	/**
	 * @return the $url
	 */
	public function getUrl() {
		return $this->url;
	}

	/**
	 * @param string $url
	 */
	public function setUrl($url) {
		$this->url = $url;
	}


	
	
}