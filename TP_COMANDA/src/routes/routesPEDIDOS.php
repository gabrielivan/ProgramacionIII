<?php

use App\Models\ORM\pedido_productoController;
use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\ORM\pedidoController;

include_once __DIR__ . '/../../src/app/modelORM/pedidoController.php';
include_once __DIR__ . '/../../src/app/modelORM/pedido_productoController.php';
return function (App $app) {


    $app->group('/pedidos', function () {

        $this->post('/', pedidoController::class . ':CargarUno')->add(Middleware::class . ":EsMozo")
        ->add(Middleware::class . ":validarToken");

        $this->get('/verPendientes', pedido_productoController::class . ':verPedidosPendientes');

        $this->post('/baja', pedidoController::class . ':BorrarUno');
        
        $this->post('/modificar', pedidoController::class . ':ModificarUno');
        
        $this->get('/', pedidoController::class . ':TraerTodos');
        
        $this->get('/traerUno', pedidoController::class . ':TraerUno');
    });
};
