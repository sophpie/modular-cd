<?php
namespace Common\Model;

trait PersistentTrait
{
    /**
     * Mongo DB Id
     * 
     * @ODm\Id
     * @var MongoDB
     */
    protected $id;
    
	/**
	 * @return the $id
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param \Common\Model\MongoDB $id
	 */
	public function setId($id) {
		$this->id = $id;
	}
}