<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\ORM\userController;

include_once __DIR__ . '/../../src/app/modelORM/user.php';
include_once __DIR__ . '/../../src/app/modelORM/userController.php';

return function (App $app) {
    $container = $app->getContainer();

     $app->group('/users', function () {   
         
        $this->get('/',userController::class . ':traerTodos');

        // localhost:80/Practica_Segundo_Parcial/public/users/
        // localhost/Practica_Segundo_Parcial/public/users/
        $this->post('/',userController::class . ':CargarUno')->add(Middleware::class . ":log");

    });

};