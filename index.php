<?php

define("ROOT", dirname(__FILE__));


require_once(ROOT . '/components/autoload.php');

require_once(ROOT . '/components/Router.php');

$router = new App\Components\Router();
$router->handle();