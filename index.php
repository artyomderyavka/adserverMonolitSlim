<?php
/**
 * Created by PhpStorm.
 * Date: 27.07.2017
 * Time: 12:49
 */


use Symfony\Component\Yaml\Yaml;


//tideways_enable();
error_reporting(E_ALL);
ini_set('display_errors', 1);
require './vendor/autoload.php';

$monolithRoutes = Yaml::parse(file_get_contents('./src/config/routes.yml'));
$serviceTargetRoutes = Yaml::parse(file_get_contents('./services/adservertargetslim/src/config/routes.yml'));
$serviceContentRoutes = Yaml::parse(file_get_contents('./services/adservercontentslim/src/config/routes.yml'));

$routes = array_merge($monolithRoutes, $serviceTargetRoutes, $serviceContentRoutes);

$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];

$container = new \Slim\Container($configuration);
$container['targetServiceClient'] = function ($container) {
    return new \AdServer\LocalClient();
};
$container['contentServiceClient'] = function ($container) {
    return new \AdServer\LocalClient();
};
\AdServer\Engine::run($container, $routes);

