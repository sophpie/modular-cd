<?php
namespace Hal\Model;

class Link implements \JsonSerializable
{
    /**
     * href data
     * 
     * @var string
     */
    protected $href;

    /**
     * Construtcor
     * 
     * @param string $href
     */
    public function __construct($href)
    {
        $this->href = $href;
    }
    
    /**
     * (non-PHPdoc)
     * @see JsonSerializable::jsonSerialize()
     */
    public function jsonSerialize ()
    {
        return array('href' => $this->href);
    }
}