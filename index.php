<?php

require_once 'core/App.php';

define('CONTROLLER_NAMESPACE', '\Controllers\\');
define('DEFAULT_CONTROLLER', 'IndexController');
define('DEFAULT_ACTION', 'Index');
define('ACTION_PARAM', 'act');

App::run();