<?php
namespace Common\Model;

interface PersistentInterface
{
	/**
	 * Return MongoDB ID
	 * 
	 * @return the $id
	 */
	public function getId();
	
	/**
	 * Set MongoDb ID
	 * 
	 * @param \Common\Model\MongoDB $id
	 */
	public function setId($id);
}