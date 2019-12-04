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

        $this->post('/altaPedido', pedidoController::class . ':altaPedido')->add(Middleware::class . ":EsMozo")
                                                                           ->add(Middleware::class . ":validarToken");

        $this->get('/verPendientes', pedido_productoController::class . ':verPedidosPendientes');

        $this->post('/bajaPedido', pedidoController::class . ':bajaPedido');
        
        $this->post('/modificarPedido', pedidoController::class . ':modificarPedido');
        
        $this->get('/traerPedidos', pedidoController::class . ':traerPedidos');
        
        $this->get('/traerUnPedido', pedidoController::class . ':traerUnPedido');
    });
};
