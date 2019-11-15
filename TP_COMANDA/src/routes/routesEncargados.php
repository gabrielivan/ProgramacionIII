<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\ORM\encargadosControler;

include_once __DIR__ . '/../../src/app/modelORM/encargadosControler.php';

return function (App $app) {
    $container = $app->getContainer();

	$app->group('/encargados', function(){

        $this->post('/iniciarSesion', encargadosControler::class . ':iniciarSesion');

        $this->post('/altaEncargado', encargadosControler::class . ':altaEncargado');

        $this->post('/bajaEncargado', encargadosControler::class . ':bajaEncargado');
        
        $this->post('/modificarEncargado', encargadosControler::class . ':modificarEncargado');
        
        $this->get('/traerEncargados', encargadosControler::class . ':traerEncargados');
        
        $this->get('/traerUnEncargado/{id}', encargadosControler::class . ':traerUnEncargado');

    });

};
