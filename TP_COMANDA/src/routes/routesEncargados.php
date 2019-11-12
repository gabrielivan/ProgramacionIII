<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\ORM\encargadosControler;

include_once __DIR__ . '/../../src/app/modelORM/encargadosControler.php';

return function (App $app) {
    $container = $app->getContainer();

	$app->group('/encargados', function(){

        $this->post('/logIn', encargadosControler::class . ':logIn');

        $this->post('/altaEncargado', encargadosControler::class . ':altaEncargado');

        $this->get('/bajaEncargado', encargadosControler::class . ':bajaEncargado');
        
        $this->get('/modificarEncargado', encargadosControler::class . ':modificarEncargado');
        
        $this->get('/traerEncargados', encargadosControler::class . ':traerEncargados');

    });

};
