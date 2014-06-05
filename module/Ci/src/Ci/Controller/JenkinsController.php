<?php
namespace Ci\Controller;

use Hal\Controller\ControllerAbstract;
use Hal\Model\Resource;
use Repository\Model\GitHub\GitHubRepository;
use ZendPattern\Jenkins\CiServer;

class JenkinsController extends ControllerAbstract
{
    public function getList()
    {
        $jenkins = new CiServer('test','cd.jenkins.dev');
        $jenkins->performBuild('job de test');
        
    }
}
