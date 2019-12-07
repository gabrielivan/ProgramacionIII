<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\ORM\Pedido;
use App\Models\ORM\Producto;
use App\Models\ORM\productoController;
use App\Models\ORM\cdApi;


include_once __DIR__ . '/../../src/app/modelORM/producto.php';
include_once __DIR__ . '/../../src/app/modelORM/productoController.php';

return function (App $app) {
  $container = $app->getContainer();


  $app->group('/cdORM2', function () {

    $this->get('/', cdApi::class . ':traerTodos');
  });
};
