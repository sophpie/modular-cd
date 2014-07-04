<?php
namespace Extension\GitHub\Model\Device;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Environment\Model\Device\Device;
use Github\Client as GithubClient;

/** @ODM\Document */
class GitHub extends Device
{
	/**
	 * Device type identifier
	 *
	 * @var string
	 */
	protected $deviceType = 'github';
	
	/**
	 * GitHub user
	 * 
	 * @ODM\String
	 * @var string
	 */
	protected $user;
	
	/**
	 * GitHub repository
	 *
	 * @ODM\String
	 * @var string
	 */
	protected $repository;
	
	/**
	 * GitHub Api Client
	 * 
	 * @var GithubClient
	 */
	protected $apiClient;
	
	public function getRepository()
	{
		$repository = $this->getApiClient()->api('repos')->show($this->user,$this->repository);
		return $repository;
	}
	
	/**
	 * @return the $apiClient
	 */
	public function getApiClient() {
		if ( ! $this->apiClient){
			$this->apiClient = new GithubClient();
		}
		return $this->apiClient;
	}

	/**
	 * @param \Github\Client $apiClient
	 */
	public function setApiClient($apiClient) {
		$this->apiClient = $apiClient;
	}
	
	/**
	 * @return the $user
	 */
	public function getUser() {
		return $this->user;
	}

	/**
	 * @param string $user
	 */
	public function setUser($user) {
		$this->user = $user;
	}

}
