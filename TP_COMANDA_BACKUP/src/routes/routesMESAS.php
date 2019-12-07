<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\ORM\mesaController;

include_once __DIR__ . '/../../src/app/modelORM/mesaController.php';
return function (App $app) {


    $app->group('/mesas', function () {

        $this->post('/altaMesa', mesaController::class . ':altaMesa');

        $this->post('/bajaMesa', mesaController::class . ':bajaMesa');
        
        $this->post('/modificarMesa', mesaController::class . ':modificarMesa');
        
        $this->get('/traerMesas', mesaController::class . ':traerMesas');
        
        $this->get('/obtenerMesaLibre', mesaController::class . ':obtenerMesaLibre');
        
        $this->get('/traerUnaMesa{id}', mesaController::class . ':traerUnaMesa');
    });
};
