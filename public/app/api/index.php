<?php
/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
$workingDir = realpath(dirname(__DIR__ . '/../../../../'));
chdir($workingDir);

// Setup autoloading
require 'init_autoloader.php';

// Run the application!
Zend\Mvc\Application::init(require 'config/application.config.php')->run();
