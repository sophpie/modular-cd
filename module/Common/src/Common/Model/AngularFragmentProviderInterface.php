<?php
namespace Common\Model;

interface AngularFragmentProviderInterface
{
	/**
	 * Get Angular JS fragment directory
	 *
	 * @return string
	 */
	public function getAngularFragmentDir();
}