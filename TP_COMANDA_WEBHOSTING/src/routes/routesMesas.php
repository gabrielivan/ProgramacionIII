<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\ORM\mesaController;

include_once __DIR__ . '/../../src/app/modelORM/mesaController.php';
return function (App $app) {


    $app->group('/mesas', function () {

        $this->post('/altaMesa', mesaController::class . ':altaMesa')->add(Middleware::class . ":log")
                                                                     ->add(Middleware::class . ":EsSocio")
                                                                     ->add(Middleware::class . ":validarToken");

        $this->post('/bajaMesa', mesaController::class . ':bajaMesa')->add(Middleware::class . ":log")
                                                                     ->add(Middleware::class . ":EsSocio")
                                                                     ->add(Middleware::class . ":validarToken");
        
        $this->post('/modificarMesa', mesaController::class . ':modificarMesa')->add(Middleware::class . ":log")
                                                                               ->add(Middleware::class . ":EsSocio")
                                                                               ->add(Middleware::class . ":validarToken");
        
        $this->get('/traerMesas', mesaController::class . ':traerMesas');
        
        $this->get('/traerUnaMesa{id}', mesaController::class . ':traerUnaMesa');
        
        $this->get('/obtenerMesaLibre', mesaController::class . ':obtenerMesaLibre')->add(Middleware::class . ":log")
                                                                                    ->add(Middleware::class . ":EsMozo")
                                                                                    ->add(Middleware::class . ":validarToken");

        ////////////////////////////////INFORMES////////////////////////////////////////////

        $this->get('/traerMesaMasUsada', mesaController::class . ':traerMesaMasUsada');
        
        $this->get('/traerMesaMenosUsada', mesaController::class . ':traerMesaMenosUsada');

        $this->get('/traerMesaConElMayorImporte', mesaController::class . ':traerMesaConElMayorImporte');
        
        $this->get('/traerMesaConElMenorImporte', mesaController::class . ':traerMesaConElMenorImporte');
        
        // $this->get('/traerMesaQueMasFacturo', mesaController::class . ':traerMesaQueMasFacturo');
        
        // $this->get('/traerMesaQueMenosFacturo', mesaController::class . ':traerMesaQueMenosFacturo');
        
    });
};
