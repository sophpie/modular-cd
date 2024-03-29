<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Zend\Paginator;

use Zend\Paginator\Adapter\AdapterInterface;

/**
 * Interface that aggregates a Zend\Paginator\Proxy\Abstract just like IteratorAggregate does for Iterators.
 */
interface AdapterAggregateInterface
{
    /**
     * Return a fully configured Paginator Proxy from this method.
     *
     * @return AdapterInterface
     */
    public function getPaginatorAdapter();
}
