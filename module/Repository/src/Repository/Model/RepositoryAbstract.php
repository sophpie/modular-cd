<?php
namespace Repository\Model;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/** @ODM\MappedSuperClass */
abstract class RepositoryAbstract implements RepositoryInterface
{
    /**
     * Mongo Db id
     * @ODM\Id
     * @var unknown
     */
    protected $id;
    
    /**
     * Repository name
     * 
     * @var string
     * @ODM\String
     */
    protected $name;
    
	/**
	 * @param string $name
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * @return the $name
	 */
	public function getName() {
		return $this->name;
	}

}