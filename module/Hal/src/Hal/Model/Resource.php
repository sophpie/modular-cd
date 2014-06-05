<?php
namespace Hal\Model;

class Resource implements \JsonSerializable
{
    const LINK_TYPE_SELF = 'self';
    const LINK_TYPE_FIRST = 'first';
    const LINK_TYPE_LAST = 'last';
    const LINK_TYPE_NEXT = 'next';
    const LINK_TYPE_PREV = 'prev';
    
    /**
     * Links
     * 
     * @var array
     */
    protected $links = array(self::LINK_TYPE_SELF => '');
    
    /**
     * Embedded objects
     * 
     * @var array
     */
    protected $embedded = array();
    
    /**
     * Resource properties
     * 
     * @var array
     */
    protected $properties = array();
    
    /**
     * Set links
     * 
     * @param string $type
     * @param string $href
     */
    public function addLink($type,$href)
    {
    	$this->links[$type] = new Link($href);
    }
    
    /**
     * Add property value
     * 
     * @param string $name
     * @param mixed $value
     */
    public function addProperty($name,$value)
    {
    	$this->properties[$name] = $value;
    }
    
    /**
     * Get property value
     * 
     * @param string $name
     * @return multitype:
     */
    public function getProperty($name)
    {
    	return $this->properties[$name];
    }
    
    /**
     * (non-PHPdoc)
     * @see JsonSerializable::jsonSerialize()
     */
    public function jsonSerialize ()
    {
        $jsonArray = array();
        $jsonArray['_links'] = $this->links;
        foreach ($this->properties as $name => $value)
        {
        	$jsonArray[$name] = $value;
        }
        foreach ($this->embedded as $name => $resource)
        {
        	if (is_array($resource)) {
        		$jsonArray[$name] = array();
        		foreach ($resource as $res) {
        			$jsonArray[$name][] = $res->jsonSerialize();
        		}
        	}
        	else $jsonArray[$name] = $resource->jsonSerialize();
        }
        return $jsonArray;
    }
    
    /**
     * Add an embedded resource
     * 
     * @param string $name
     * @param Resource|Array $resource
     */
    public function addEmbbeded($name,$resource)
    {
    	$this->embedded[$name] = $resource;
    }
    
    /**
     * Get embedded resources
     * 
     * @return array
     */
    public function getEmbedded()
    {
    	return $this->embedded;
    }
}