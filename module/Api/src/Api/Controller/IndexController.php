<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Api for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Api\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use ZendPattern\Zsf\Server\ZendServer;
use ZendPattern\Zsf\ApiKey\ApiKey;
use ZendPattern\Zsf\Target\Target;
use ZendPattern\Zsf\Server\ZendServer6;
use ZendPattern\Zsf\Api\Key\Key;
use ZendPattern\Zsf\Feature\ZendServer6\LocalProperties;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $server = new ZendServer6();
        $server->autoDiscover('485bb6c73f3a98cf3f63e6c2d2f18ce34edc1046f673b2158916b03e214eb99b');
        return array();
    }
}
