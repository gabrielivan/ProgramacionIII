<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\ORM\productoController;

include_once __DIR__ . '/../../src/app/modelORM/productoController.php';
return function (App $app) {

    $app->group('/productos', function () {

        $this->post('/altaProducto', productoController::class . ':altaProducto');

        $this->post('/bajaProducto', productoController::class . ':bajaProducto');

        $this->post('/modificarProducto', productoController::class . ':modificarProducto');

        $this->get('/traerProductos', productoController::class . ':traerProductos');

        $this->get('/traerUnProducto{id}', productoController::class . ':traerUnProducto');
        
    });
};
