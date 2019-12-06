<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\cd;
use App\Models\cdApi;



return function (App $app) {
    $container = $app->getContainer();

    // // Rutas ORM
    // $routes = require __DIR__ . '/../src/routes/routesORM.php';
    // $routes($app);
    
    // Rutas Encargados
    $routes = require __DIR__ . '/../src/routes/routesEncargados.php';
    $routes($app);

    // // Rutas Pedidos
    // $routes = require __DIR__ . '/../src/routes/routesPedidos.php';
    // $routes($app);


    $app->get('/[{name}]', function (Request $request, Response $response, array $args) use ($container) {
        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/' route");
        // $container->get('logger')->addCritical('Hey, a critical log entry!');
        return $container->get('renderer')->render($response, 'index.phtml', $args);
    });




};