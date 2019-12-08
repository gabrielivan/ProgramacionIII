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

        $this->post('/bajaPedido', pedidoController::class . ':bajaPedido')->add(Middleware::class . ":EsMozo")
                                                                           ->add(Middleware::class . ":validarToken");
        
        $this->post('/modificarPedido', pedidoController::class . ':modificarPedido')->add(Middleware::class . ":EsMozo")
                                                                                     ->add(Middleware::class . ":validarToken");
        
        $this->get('/traerPedidos', pedidoController::class . ':traerPedidos');
        
        $this->get('/traerUnPedido', pedidoController::class . ':traerUnPedido');

        $this->post('/prepararPedido', pedidoController::class . ':prepararPedido') ->add(Middleware::class . ":validarToken");

        $this->post('/terminarPedido', pedidoController::class . ':terminarPedido') ->add(Middleware::class . ":validarToken");

        $this->post('/servirPedido', pedidoController::class . ':servirPedido')->add(Middleware::class . ":EsMozo")
                                                                               ->add(Middleware::class . ":validarToken");
        
        $this->get('/pedirCuenta', pedidoController::class . ':pedirCuenta')->add(Middleware::class . ":EsMozo")
                                                                            ->add(Middleware::class . ":validarToken");
        
        $this->get('/cobrarPedido', pedidoController::class . ':cobrarPedido')->add(Middleware::class . ":EsMozo")
                                                                              ->add(Middleware::class . ":validarToken");
        
        $this->get('/verPendientes', pedido_productoController::class . ':verPedidosPendientes')->add(Middleware::class . ":validarToken");

        /////////////////////////////////INFORMES////////////////////////////////////////////
        
        $this->get('/traerLoQueMasSeVendio', pedidoController::class . ':traerLoQueMasSeVendio');
        
        $this->get('/traerLoQueMenosSeVendio', pedidoController::class . ':traerLoQueMenosSeVendio');

    });
};
