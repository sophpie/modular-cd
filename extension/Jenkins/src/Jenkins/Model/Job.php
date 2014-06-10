<?php
namespace Extension\Jenkins\Model;

class Job
{
	/**
	 * Job name
	 * 
	 * @var string
	 */
	protected $name;
	
	protected $url;
	
	protected $actions = array();
	
	protected $description;
	
	protected $displayName;
	
	protected $displayNameOrNull;
	
	protected $buildable = true;
	
	protected $builds = array();
	
	protected $color;
	
	protected $firstBuild;
	
	protected $healthReport;
	
	protected $inQueue = false;
	
	protected $keepDependencies = false;
	
	protected $nextBuildNumber;
	
	protected $property;
	
	protected $queueItem;
	
	protected $concurrentBuild = false;
	
	protected $downstreamProjects = array();
	
	protected $scm;
	
	protected $upstreamProjects = array();
	
}