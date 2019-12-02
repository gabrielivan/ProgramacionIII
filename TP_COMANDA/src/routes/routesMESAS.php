<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\ORM\mesaController;

include_once __DIR__ . '/../../src/app/modelORM/mesaController.php';
return function (App $app) {


    $app->group('/mesas', function () {

        $this->post('/', mesaController::class . ':CargarUno');

        $this->post('/baja', mesaController::class . ':BorrarUno');
        
        $this->post('/modificar', mesaController::class . ':ModificarUno');
        
        $this->get('/', mesaController::class . ':TraerTodos');
        
        $this->get('/obtenerMesaLibre', mesaController::class . ':obtenerMesaLibre');
        
        $this->get('/{id}', mesaController::class . ':TraerUno');
    });
};
