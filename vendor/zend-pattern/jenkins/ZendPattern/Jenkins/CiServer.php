<?php
namespace ZendPattern\Jenkins;

use ZendPattern\Jenkins\Api\ApiClient;
use Zend\Uri\Http as HttpUri;
use ZendPattern\Jenkins\Api\ApiRequest;
use Zend\Http\Request;

class CiServer
{
	/**
	 * CiServer name
	 * 
	 * @var string
	 */
	protected $name;
	
	/**
	 * CiServer BaseUrl
	 * 
	 * @var Uri
	 */
	protected $uri;
	
	/**
	 * Api client
	 * 
	 * @var ApiClient
	 */
	protected $apiClient;
	
	/**
	 * 
	 * @var unknown
	 */
	protected $overallLoadStats =array();
	
	/**
	 * 
	 * @param unknown $name
	 * @param unknown $baseUrl
	 */
	public function __construct($name,$host = 'localhost',$port = '8080',$scheme = 'http')
	{
		$this->name = $name;
		$this->uri = new HttpUri();
		$this->uri->setHost($host);
		$this->uri->setPort($port);
		$this->uri->setScheme($scheme);
	}
	
	/**
	 * Restart Jenkins server
	 */
	public function restart()
	{
		$request = new ApiRequest();
		$uri = clone $this->uri;
		$uri->setPath('/restart');
		$request->setUri($uri);
		$request->setMethod(Request::METHOD_POST);
		$response = $this->getApiClient()->send($request);
	}
	
	/**
	 * Perform a build
	 * 
	 * @param array $params
	 */
	public function performBuild($jobName,$params = array())
	{
		$request = new ApiRequest();
		$uri = clone $this->uri;
		$path = '/job/' . rawurlencode($jobName);
		if (count($params) == 0) $path .= '/build';
		else $path .= '/buildWithParameters';
		$uri->setPath($path);
		$request->setUri($uri);
		$request->setMethod(Request::METHOD_POST);
		$response = $this->getApiClient()->send($request);
		var_dump($response);
	}
	
	/**
	 * Get overall load statistics
	 */
	public function getStatistics()
	{
		$request = new ApiRequest();
		$uri = clone $this->uri;
		$uri->setPath('/overallLoad/api/json');
		$request->setUri($uri);
		$request->setMethod(Request::METHOD_GET);
		$response = $this->getApiClient()->send($request);
		$json = $response->getBody();
		$this->overallLoadStats = json_decode($json,true);
	}
	
	/**
	 * @return the $name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @return the $apiClient
	 */
	public function getApiClient() {
		if ( ! $this->apiClient) $this->apiClient = new ApiClient();
		return $this->apiClient;
	}

	/**
	 * @param field_type $apiClient
	 */
	public function setApiClient($apiClient) {
		$this->apiClient = $apiClient;
	}

}