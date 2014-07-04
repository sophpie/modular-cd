<?php
namespace Repository\Model\GitHub;

interface GitHubRepositoryInterface
{
    /**
     * Return GitHub URI repository
     */
    public function getUri();
}