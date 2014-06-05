<?php
namespace Repository\Model\GitHub;

use Repository\Model\GitHub\GitHubRepositoryInterface;
use Repository\Model\RepositoryAbstract;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/** @ODM\Document(collection="repository") */
class GitHubRepository extends RepositoryAbstract implements GitHubRepositoryInterface 
{
    /**
     * GitHub Uri
     * 
     * @var string
     * @ODM\String
     */
    protected $uri;
    
    /**
     * (non-PHPdoc)
     * @see \Repository\Model\GitHub\GitHubRepositoryInterface::getUri()
     */
    public function getUri()
    {
        return $this->uri;
    }
    
    /**
     * 
     * @param unknown $uri
     */
    public function setUri($uri)
    {
        $this->uri = $uri;
    }
}