<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\ORM\encargadoController;

include_once __DIR__ . '/../../src/app/modelORM/encargadoController.php';

return function (App $app) {

	$app->group('/encargados', function(){

        $this->post('/iniciarSesion', encargadoController::class . ':iniciarSesion');

        $this->post('/altaEncargado', encargadoController::class . ':altaEncargado')->add(Middleware::class . ":log")
                                                                                    ->add(Middleware::class . ":EsSocio")
                                                                                    ->add(Middleware::class . ":validarToken");

        $this->post('/bajaEncargado', encargadoController::class . ':bajaEncargado')->add(Middleware::class . ":log")
                                                                                    ->add(Middleware::class . ":EsSocio")
                                                                                    ->add(Middleware::class . ":validarToken");
        
        $this->post('/modificarEncargado', encargadoController::class . ':modificarEncargado')->add(Middleware::class . ":log")
                                                                                              ->add(Middleware::class . ":EsSocio")
                                                                                              ->add(Middleware::class . ":validarToken");
        
        $this->get('/traerEncargados', encargadoController::class . ':traerEncargados');
        
        $this->get('/traerUnEncargado/{id}', encargadoController::class . ':traerUnEncargado');

        /////////////////////////////////INFORMES////////////////////////////////////////////

        $this->get('/traerOperacionesDeTodosLosEncargados', encargadoController::class . ':traerOperacionesDeTodosLosEncargados');

    });

};
