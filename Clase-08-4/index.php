<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require_once './vendor/autoload.php';
require_once './clases/alumno.php';
require_once './clases/genericDao.php';
require_once './clases/alumnoController.php';
require_once './clases/cdApi.php';


$config ['displayErrorDetails'] = true;
$config ['addContentLengthHeader'] = false;

$app = new \Slim\App(["settings" => $config]);

$app->group('/alumno', function() {
    
    $this->get('/{case}/[{campo}]', cdApi::class . ':controllerGet');

    $this->post('/{case}', cdApi::class . ':controllerPost');
    
    $this->delete('/', cdApi::class . ':borrarUno');

});

$app -> run();


