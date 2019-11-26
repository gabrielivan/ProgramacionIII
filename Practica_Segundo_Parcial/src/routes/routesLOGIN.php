<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\ORM\userController;

include_once __DIR__ . '/../../src/app/modelORM/user.php';
include_once __DIR__ . '/../../src/app/modelORM/userController.php';

return function (App $app) {
    $container = $app->getContainer();

     $app->group('/login', function () {   

        $this->post('/',userController::class . ':IniciarSesion')->add(Middleware::class . ":log");
    });

    $app->group('/ingreso', function () {   
        $this->post('/',userController::class . ':ingresoUsuario')->add(Middleware::class . ":log");
        $this->get('/',userController::class . ':traerTodosLosIngresos')->add(Middleware::class . ":validarToken");
    });

    $app->group('/egreso', function () {   

        $this->post('/',userController::class . ':egresoUsuario')->add(Middleware::class . ":log");
    });


};