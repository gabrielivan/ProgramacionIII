<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\cd;
use App\Models\cdApi;



return function (App $app) {
    $container = $app->getContainer();

    // Rutas PDO
    $routes = require __DIR__ . '/../src/routes/routesPDO.php';
    $routes($app);

    // Rutas ORM
    $routes = require __DIR__ . '/../src/routes/routesORM.php';
    $routes($app);

    // Rutas JWT
    $routes = require __DIR__ . '/../src/routes/routesJWT.php';
    $routes($app);

    // Rutas PEDIDOS
    $routes = require __DIR__ . '/../src/routes/routesPEDIDOS.php';
    $routes($app);

    // Rutas PRODUCTOS
    $routes = require __DIR__ . '/../src/routes/routesPRODUCTOS.php';
    $routes($app);

    // Rutas ENCARGADOS
    $routes = require __DIR__ . '/../src/routes/routesENCARGADOS.php';
    $routes($app);

        // Rutas MESAS
        $routes = require __DIR__ . '/../src/routes/routesMESAS.php';
        $routes($app);




    $app->get('/[{name}]', function (Request $request, Response $response, array $args) use ($container) {
        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/' route");
        // $container->get('logger')->addCritical('Hey, a critical log entry!');
        return $container->get('renderer')->render($response, 'index.phtml', $args);
    });
};
