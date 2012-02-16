<?php
// Define Directories
defined('INCLUDE_DIR') or
    define('INCLUDE_DIR', realpath(dirname(__FILE__) .'/include'));
defined('CONTROLLER_DIR') or
    define('CONTROLLER_DIR', realpath(dirname(__FILE__) .'/controllers'));
defined('VIEW_DIR') or
    define('VIEW_DIR', realpath(dirname(__FILE__) .'/views'));

// read the config file

// require the libraries which we will be using
require_once INCLUDE_DIR .'/PageError/PageError.php';
require_once INCLUDE_DIR .'/php-router/php-router.php';
require_once INCLUDE_DIR .'/Twig/lib/Twig/Autoloader.php';

// register the Twig Autoloader
Twig_Autoloader::register();

// Create a new instance of Router (you'd likely use a factory or container to
// manage the instance)
$router = new Router;

// Get an instance of Dispatcher
$dispatcher = new Dispatcher;
$dispatcher->setSuffix('Controller');
$dispatcher->setClassPath(CONTROLLER_DIR);

// Set up your default route:
$default_route = new Route('/');
$default_route->setMapClass('default')->setMapMethod('index');
$router->addRoute('default', $default_route);

$url = urldecode($_SERVER['REQUEST_URI']);

try {
    $found_route = $router->findRoute($url);
    $dispatcher->dispatch( $found_route );
} catch ( RouteNotFoundException $e ) {
    PageError::show('404', $url);
} catch ( badClassNameException $e ) {
    PageError::show('400', $url);
} catch ( classFileNotFoundException $e ) {
    PageError::show('500', $url);
} catch ( classNameNotFoundException $e ) {
    PageError::show('500', $url);
} catch ( classMethodNotFoundException $e ) {
    PageError::show('500', $url);
} catch ( classNotSpecifiedException $e ) {
    PageError::show('500', $url);
} catch ( methodNotSpecifiedException $e ) {
    PageError::show('500', $url);
}