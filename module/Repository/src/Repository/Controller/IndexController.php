<?php
namespace Repository\Controller;

use Hal\Controller\ControllerAbstract;
use Hal\Model\Resource;
use Repository\Model\GitHub\GitHubRepository;

class IndexController extends ControllerAbstract
{
    public function getList()
    {
        $dm = $this->serviceLocator->get('doctrine.documentmanager.odm_default');
        $repository = new GitHubRepository();
        $repository->setName('test');
        $repository->setUri('https://github.com/zut');
        var_dump($repository);
        var_dump($dm->persist($repository));
        $dm->flush();
        
        
        $object = $dm->getRepository('Repository\Model\GitHub\GitHubRepository')->findAll();
        var_dump($object);
        die();
        $resource = new Resource($object);
        $resource->setSelfLink($this->getRequest()->getUriString());
        return $resource;
    }
    
    public function get($id)
    {
        var_dump($id);
    }
    
    public function create($data)
    {
        $repository = new GitHubRepository();
        $repository->setName('test');
        $dm = $this->serviceLocator->get('doctrine.documentmanager.odm_default');
        $dm->persist($repository);
        $dm->flush();
    }
}
