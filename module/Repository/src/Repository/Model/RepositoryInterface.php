<?php
namespace Repository\Model;

interface RepositoryInterface
{
    /**
     * Get repository name
     * 
     * @return string
     */
    public function getName();
}