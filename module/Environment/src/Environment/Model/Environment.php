<?php
namespace Environment\Model;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/** @ODM\Document(collection="environment") */
class Environment extends EnvironmentAbstract
{
    
}