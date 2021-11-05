<?php

use App\Repositories\ProductsRepository;
use App\Repositories\UsersRepository;
use App\View;
use DI\Container;
use function DI\create;

session_start();
require_once 'vendor/autoload.php';

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', 'ProductsController@index');
    $r->addRoute('GET', '/add-product', 'ProductsController@create');
    $r->addRoute('POST', '/add-product', 'ProductsController@store');
    $r->addRoute('POST', '/delete', 'ProductsController@delete');
});

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$loader = new \Twig\Loader\FilesystemLoader('app/Views');
$templateEngine = new \Twig\Environment($loader);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

$container = new Container();

switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];

        [$controller, $method] = explode('@',$handler);
        $controller ='App\Controllers\\'.$controller;

        $controller = $container->get($controller);

        $response = $controller->$method($vars);

        if ($response instanceof View)
        {
            echo $templateEngine->render(
                $response->getTemplate(),
                $response->getArguments()
            );
        }
        break;
}